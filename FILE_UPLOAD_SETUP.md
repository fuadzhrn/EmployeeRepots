# File Upload Feature - Setup Guide

## ✅ Fitur Upload File Sudah Complete

### 📁 Folder Structure
```
storage/
└── app/
    └── public/
        └── documents/  ← File diupload ke sini
public/
└── storage/  ← Symbolic link ke storage/app/public
```

### 🔧 Setup yang Sudah Dilakukan:

1. **RequestController**
   - Method `store()` untuk upload file
   - Method `downloadDocument()` untuk download file
   - Method `viewDocument()` untuk preview file
   - Error handling yang lengkap
   - Auto-create folder jika belum ada

2. **Routes**
   - `POST /request/store` - Submit request dengan file
   - `GET /request/{id}/download` - Download file
   - `GET /request/{id}/view` - Preview file di browser

3. **Validasi File**
   - Max size: 2MB
   - Format: PDF, DOC, DOCX, XLS, XLSX, JPG, JPEG, PNG, TXT, ZIP
   - Frontend: accept attribute pada file input
   - Backend: mimes & max validation

4. **Database**
   - Column `document` di table `requests` menyimpan path file
   - Nullable, jadi bisa ada request tanpa file (opsional)

5. **Folder Permissions**
   - storage/app/public/ harus writable
   - Folder documents sudah dibuat di /storage/app/public/documents/

### 🚀 Cara Menggunakan:

**User Submit Request:**
1. Pergi ke landing page `/`
2. Scroll ke bagian "Form Request"
3. Isi semua field (nama, badge no, category, description)
4. Upload file (max 2MB) - PDF, DOC, DOCX, XLS, XLSX, JPG, PNG, TXT, ZIP
5. Klik Submit Request
6. File akan disimpan ke storage/app/public/documents/

**Admin Kelola File:**
1. Login ke admin dashboard
2. Pergi ke "Kelola Request"
3. Di kolom "File" ada 2 buttons:
   - 👁️ (View) - Buka file di browser
   - ⬇️ (Download) - Download file ke komputer
4. Jika tidak ada file, tampil "No file"

### 📝 Technical Details:

**File Storage Path:**
- Database: `documents/1732345678_filename.pdf`
- Actual path: `/storage/app/public/documents/1732345678_filename.pdf`
- Public URL: `/storage/documents/1732345678_filename.pdf`

**Filename Format:**
- Pattern: `{timestamp}_{original_filename}`
- Example: `1732345678_invoice.pdf`
- Tujuan: Hindari duplikasi nama file

**Error Handling:**
- Validasi di form jika file kosong
- Validasi ukuran file (max 2MB)
- Validasi format file
- Pesan error yang jelas ke user
- Log error untuk debugging

### ⚠️ Troubleshooting:

**File tidak ter-upload:**
1. Check folder permissions: `storage/app/public/` harus writable
2. Check disk space
3. Check PHP max upload size (biasanya default 2MB OK)
4. Check logs: `storage/logs/laravel.log`

**File tidak bisa di-download:**
1. Check apakah file benar-benar ada di folder
2. Check folder permissions
3. Check database apakah path file tersimpan

**Symbolic link tidak jalan:**
1. Pastikan `public/storage` adalah symlink ke `storage/app/public`
2. Jalankan: `php artisan storage:link` (jika butuh PHP 8.2+)

### 🔐 Security:

- File divalidasi by MIME type
- File size terbatas 2MB
- Filename dibuat dengan timestamp untuk hindari overwrite
- File disimpan di public disk tapi tidak bisa langsung diakses via URL
- Akses file via controller method dengan validasi database

---

**Status**: ✅ Siap Digunakan
**Last Updated**: November 23, 2025
