<?php

namespace App\Http\Controllers;

use App\Models\Request as RequestModel;
use App\Mail\NewRequestSubmitted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class RequestController extends Controller
{
    /**
     * Store a newly created request in storage.
     */
    public function store(Request $request)
    {
        // Validasi input - relaxed mimes validation
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nomor' => 'required|string|max:50',
            'category' => 'required|in:data,support_system,menu_system,maintenance,training',
            'description' => 'required|string|min:10',
            'document' => 'required|file|max:2048', // Max 2MB, remove strict mime check
        ], [
            'nama.required' => 'Request name harus diisi',
            'nomor.required' => 'Badge No harus diisi',
            'category.required' => 'Category harus dipilih',
            'description.required' => 'Description harus diisi',
            'description.min' => 'Description minimal 10 karakter',
            'document.required' => 'Document harus diupload',
            'document.file' => 'Document harus berupa file',
            'document.max' => 'Ukuran file maksimal 2MB',
        ]);

        try {
            // Pastikan folder documents ada
            if (!Storage::disk('public')->exists('documents')) {
                Storage::disk('public')->makeDirectory('documents');
            }

            // Upload file
            $filePath = null;
            if ($request->hasFile('document')) {
                $file = $request->file('document');
                
                // Validasi file
                if (!$file->isValid()) {
                    Log::warning('File validation failed', ['error' => $file->getError()]);
                    return redirect()->back()
                        ->withInput($request->all())
                        ->with('error', 'File upload gagal. Silahkan coba lagi.');
                }

                // Validasi extension client-side
                $allowedExtensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'jpg', 'jpeg', 'png', 'txt', 'zip'];
                $fileExtension = strtolower($file->getClientOriginalExtension());
                
                if (!in_array($fileExtension, $allowedExtensions)) {
                    Log::warning('Invalid file extension', ['extension' => $fileExtension]);
                    return redirect()->back()
                        ->withInput($request->all())
                        ->with('error', 'Format file tidak didukung. Gunakan: pdf, doc, docx, xls, xlsx, jpg, png, txt, zip');
                }
                
                $fileName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                
                // Store file ke public disk
                $filePath = $file->storeAs('documents', $fileName, 'public');
                
                if (!$filePath) {
                    Log::error('Failed to store file', ['filename' => $fileName]);
                    return redirect()->back()
                        ->withInput($request->all())
                        ->with('error', 'Gagal menyimpan file. Silahkan cek ukuran file atau coba lagi.');
                }
                
                Log::info('File stored successfully', ['path' => $filePath, 'size' => $file->getSize()]);
            }

            // Simpan ke database
            $newRequest = RequestModel::create([
                'nama' => $validated['nama'],
                'nomor' => $validated['nomor'],
                'category' => $validated['category'],
                'description' => $validated['description'],
                'document' => $filePath,
                'status' => 'pending',
                'user_id' => null, // Bisa diisi user_id jika sudah login
            ]);

            Log::info('Request created successfully', ['nama' => $validated['nama']]);

            // Send email notification to admin
            try {
                $adminEmail = 'plnintership@gmail.com'; // Admin email yang menerima notifikasi
                Mail::to($adminEmail)->send(new NewRequestSubmitted($newRequest));
                Log::info('Email notification sent', ['to' => $adminEmail, 'request_id' => $newRequest->id]);
            } catch (\Exception $e) {
                Log::error('Failed to send email notification: ' . $e->getMessage());
                // Email gagal, tapi request tetap simpan dan return success
            }

            return redirect()->back()->with('success', 'Request berhasil dikirim! Tim kami akan segera memproses permintaan Anda.');
        } catch (\Exception $e) {
            Log::error('Request upload error: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()
                ->withInput($request->all())
                ->with('error', 'Terjadi kesalahan saat menyimpan request. Silahkan hubungi administrator.');
        }
    }

    /**
     * Download document
     */
    public function downloadDocument($id)
    {
        try {
            $request = RequestModel::findOrFail($id);

            if (!$request->document || !Storage::disk('public')->exists($request->document)) {
                return redirect()->back()->with('error', 'File tidak ditemukan');
            }

            $filePath = storage_path('app/public/' . $request->document);
            return response()->download($filePath);
        } catch (\Exception $e) {
            Log::error('Download error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal download file');
        }
    }

    /**
     * View document (untuk preview)
     */
    public function viewDocument($id)
    {
        try {
            $request = RequestModel::findOrFail($id);

            if (!$request->document || !Storage::disk('public')->exists($request->document)) {
                return redirect()->back()->with('error', 'File tidak ditemukan');
            }

            $filePath = storage_path('app/public/' . $request->document);
            return response()->file($filePath);
        } catch (\Exception $e) {
            Log::error('View error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal membuka file');
        }
    }
}
