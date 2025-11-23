<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request as RequestModel;
use App\Models\User;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function dashboard()
    {
        // Hitung statistik
        $total = RequestModel::count();
        $pending = RequestModel::where('status', 'pending')->count();
        $proses = RequestModel::where('status', 'proses')->count();
        $selesai = RequestModel::where('status', 'selesai')->count();

        $stats = [
            'total' => $total,
            'pending' => $pending,
            'proses' => $proses,
            'selesai' => $selesai,
        ];

        // Ambil 10 request terbaru
        $recentRequests = RequestModel::latest()->take(10)->get();

        // Persiapkan data untuk chart - 12 bulan terakhir
        $chartLabels = [];
        $chartPending = [];
        $chartProses = [];
        $chartSelesai = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthName = $date->format('M Y');
            $chartLabels[] = $monthName;

            // Hitung request per status per bulan
            $pending_count = RequestModel::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->where('status', 'pending')
                ->count();

            $proses_count = RequestModel::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->where('status', 'proses')
                ->count();

            $selesai_count = RequestModel::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->where('status', 'selesai')
                ->count();

            $chartPending[] = $pending_count;
            $chartProses[] = $proses_count;
            $chartSelesai[] = $selesai_count;
        }

        return view('admin.dashboard', [
            'stats' => $stats,
            'recentRequests' => $recentRequests,
            'chartLabels' => $chartLabels,
            'chartPending' => $chartPending,
            'chartProses' => $chartProses,
            'chartSelesai' => $chartSelesai,
        ]);
    }

    /**
     * Kelola requests
     */
    public function requests()
    {
        $requests = RequestModel::latest()->paginate(15);
        return view('admin.requests', ['requests' => $requests]);
    }

    /**
     * Update status request
     */
    public function updateRequestStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,proses,selesai',
        ]);

        $requestModel = RequestModel::findOrFail($id);
        $requestModel->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status request berhasil diperbarui');
    }

    /**
     * Kelola users
     */
    public function users()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users', ['users' => $users]);
    }

    /**
     * Hapus user
     */
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        
        // Jangan hapus user sendiri
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'Tidak bisa menghapus akun sendiri');
        }

        $user->delete();
        return redirect()->back()->with('success', 'User berhasil dihapus');
    }

    /**
     * Laporan
     */
    public function reports()
    {
        $totalRequests = RequestModel::count();
        $completedRequests = RequestModel::where('status', 'selesai')->count();
        
        $requestsByCategory = RequestModel::selectRaw('category, COUNT(*) as count')
            ->groupBy('category')
            ->get();

        $requestsByMonth = RequestModel::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->get();

        return view('admin.reports', [
            'totalRequests' => $totalRequests,
            'completedRequests' => $completedRequests,
            'requestsByCategory' => $requestsByCategory,
            'requestsByMonth' => $requestsByMonth,
        ]);
    }
}
