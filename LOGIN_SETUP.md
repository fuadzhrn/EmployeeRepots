# Request Management System - Login & Admin Setup

Sistem login dan admin dashboard telah berhasil diimplementasikan dengan fitur-fitur berikut:

## 📋 Credential Default (Admin Account)
- **Username**: `admin`
- **Password**: `admin123`
- **Role**: Admin

## 🔐 Sistem Login
Login menggunakan username dan password yang disimpan di database MySQL dengan password hashing menggunakan bcrypt.

### Cara Login:
1. Pergi ke halaman login: `/login`
2. Masukkan username: `admin`
3. Masukkan password: `admin123`
4. Klik tombol Login

## 📊 Admin Dashboard Features

### 1. Dashboard
- **Statistik**: Total requests, Pending, In Progress, Completed
- **Bar Chart**: Menampilkan distribusi status request selama 12 bulan terakhir
- **Recent Requests**: Tabel 10 request terbaru dengan detail

### 2. Manage Requests (`/admin/requests`)
- Melihat semua request yang masuk
- Update status request (pending → proses → selesai)
- Filter dan pagination
- View detail request

### 3. Manage Users (`/admin/users`)
- Melihat semua user terdaftar
- Hapus user (tidak bisa hapus user sendiri)
- Pagination

### 4. Reports (`/admin/reports`)
- Laporan total requests
- Request berdasarkan kategori
- Request berdasarkan bulan

## 🎨 UI Features

### Sidebar Navigation
- Dashboard
- Manage Requests
- Manage Users
- Reports
- Back to Home
- Logout

### Styling
- Modern gradient background (#007E7A to #005f5a)
- Responsive design untuk desktop, tablet, mobile
- Smooth animations dan transitions
- Status badges dengan color coding:
  - **Pending**: Orange (#f59e0b)
  - **In Progress**: Blue (#3b82f6)
  - **Completed**: Green (#10b981)

## 📱 Responsive Design

### Desktop (> 1024px)
- Sidebar fixed di kiri
- Main content dengan padding penuh

### Tablet (768px - 1024px)
- Sidebar tetap di kiri dengan width berkurang
- Main content responsive

### Mobile (< 768px)
- Sidebar horizontal di atas
- Main content full width
- Menu items dalam flex row

## 🔄 Request Status Flow

1. **Pending**: Request baru yang belum diproses
2. **Proses (In Progress)**: Request sedang dikerjakan
3. **Selesai (Completed)**: Request selesai

Admin dapat mengubah status request kapan saja.

## 📈 Chart Data

Bar chart menampilkan:
- 12 bulan terakhir (rolling window)
- 3 status request: Pending, In Progress, Completed
- Otomatis menggunakan data dari database

## 🔒 Security Features

- Password hashing menggunakan bcrypt
- CSRF protection pada semua form
- Role-based access control (RBAC)
  - Admin: Akses penuh ke dashboard
  - User: Akses terbatas (hanya form request)
- Middleware IsAdmin melindungi admin routes

## 📝 Database Schema

### Users Table
```
- id
- name
- email
- username (unique)
- password (hashed)
- role (admin/user)
- email_verified_at
- timestamps
```

### Requests Table
```
- id
- user_id (foreign key)
- nama
- nomor (badge number)
- category
- description
- document
- status (pending/proses/selesai)
- timestamps
```

## 🚀 Next Steps (Optional Enhancements)

1. Email notification saat request status berubah
2. Export report ke PDF/Excel
3. Advanced filtering dan search
4. User profile management
5. Activity logging
6. Request assignment ke staff
7. SLA tracking
8. Integration dengan email system

## ⚙️ Running the Application

### Start Server
```bash
php artisan serve
```

### Run Migrations
```bash
php artisan migrate --force
```

### Run Seeders
```bash
php artisan db:seed
```

### URL Access
- Home: `http://localhost:8000/`
- Login: `http://localhost:8000/login`
- Admin Dashboard: `http://localhost:8000/admin/dashboard`

## 📞 Support
Untuk menambah akun user baru, silahkan hubungi administrator.
Semua akun harus dibuat langsung di database untuk security.

---
Created: November 2025
Version: 1.0
