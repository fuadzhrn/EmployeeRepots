# Panduan Setup Sistem Login dan Admin Dashboard

## Fitur yang Telah Dibuat

1. **Login System**
   - Form login dengan validasi
   - Penyimpanan password terenkripsi
   - Session management
   - Redirect ke dashboard berdasarkan role

2. **Admin Dashboard**
   - Sidebar navigation
   - Statistik real-time (Total, Pending, Proses, Selesai)
   - Bar chart untuk trend request per bulan (12 bulan)
   - Tabel request terbaru

3. **Kelola Request**
   - List semua request dengan pagination
   - Update status (pending → proses → selesai)
   - Filter dan search

4. **Kelola User**
   - List semua user
   - Delete user (tidak bisa delete admin sendiri)
   - Role management

5. **Laporan**
   - Doughnut chart kategori request
   - Line chart request per bulan
   - Statistik completion rate

## Langkah Setup

### 1. Migrate Database
```bash
php artisan migrate
```

### 2. Jalankan Seeder untuk Membuat Admin Default
```bash
php artisan db:seed --class=CreateAdminSeeder
```

### 3. Akun Default Login
- **Username**: `admin`
- **Password**: `admin123`

**PENTING**: Ubah password setelah login pertama kali!

### 4. Jalankan Server
```bash
php artisan serve
```

## Struktur Database

### Tabel `users`
- id (PK)
- name (string)
- username (string, unique)
- email (string)
- password (hashed)
- role (enum: user/admin)
- created_at
- updated_at

### Tabel `requests`
- id (PK)
- nama (string)
- nomor (string - Badge Number)
- category (string)
- description (text)
- document (string - path file)
- status (enum: pending/proses/selesai)
- user_id (FK to users)
- created_at
- updated_at

## Flow Aplikasi

### User (Public)
1. Akses home page `/`
2. Submit form request di landing page
3. File akan disimpan dan request masuk status "pending"

### Admin
1. Login dengan username/password di `/login`
2. Akses dashboard di `/admin/dashboard`
3. Kelola request status di `/admin/requests`
4. Kelola user di `/admin/users`
5. Lihat laporan di `/admin/reports`

## Routes

| Method | Path | Description |
|--------|------|-------------|
| GET | `/` | Home page |
| GET | `/login` | Login form |
| POST | `/login` | Process login |
| POST | `/logout` | Logout |
| GET | `/admin/dashboard` | Admin dashboard |
| GET | `/admin/requests` | List requests |
| POST | `/admin/requests/{id}/status` | Update request status |
| GET | `/admin/users` | List users |
| DELETE | `/admin/users/{id}` | Delete user |
| GET | `/admin/reports` | View reports |

## Keamanan

1. **Password Hashing**: Menggunakan bcrypt
2. **Admin Middleware**: Hanya admin yang bisa akses admin panel
3. **CSRF Protection**: Semua form request dilindungi CSRF token
4. **Session Management**: Secure session handling

## Menambah User Baru dari Database (Cara Aman)

Sebagai admin, Anda perlu menambahkan user langsung via database:

```bash
# Akses MySQL/MariaDB
mysql -u root -p
```

```sql
USE employee_reports;
INSERT INTO users (name, username, email, password, role, created_at, updated_at)
VALUES ('Nama User', 'username', 'email@vale.com', BCRYPT('password'), 'user', NOW(), NOW());
```

Atau gunakan tinker command:
```bash
php artisan tinker
```

```php
>>> use App\Models\User;
>>> User::create(['name' => 'Nama', 'username' => 'username', 'email' => 'email@vale.com', 'password' => bcrypt('password'), 'role' => 'user']);
```

## Chart Data

### Bar Chart (Dashboard)
Menampilkan 12 bulan terakhir dengan:
- Status Pending (warna kuning)
- Status Proses (warna biru)
- Status Selesai (warna hijau)

### Doughnut Chart (Reports)
Distribusi request berdasarkan kategori

### Line Chart (Reports)
Trend request per bulan

## Customization

### Ubah Warna Tema
Edit file `public/asset/css/style.css`:
- Primary color: `#007E7A` (Teal)
- Secondary color: `#005f5a` (Dark Teal)

### Ubah Font
Google Fonts: `Montserrat` (sudah di-import)

### Tambah Menu Sidebar
Edit view di `resources/views/admin/dashboard.blade.php` dan file admin lainnya pada bagian `.sidebar-menu`

## Troubleshooting

### Password tidak terenkripsi
Pastikan menggunakan `bcrypt()` saat membuat user:
```php
User::create([
    'password' => bcrypt('password123')
]);
```

### Admin tidak bisa akses dashboard
Pastikan:
1. User memiliki role = 'admin'
2. Sudah login
3. Middleware `admin` terdaftar di `bootstrap/app.php`

### Chart tidak muncul
Pastikan CDN Chart.js aktif:
```html
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
```

## Catatan

- Untuk deploy production, ubah `APP_DEBUG=false` di `.env`
- Gunakan database yang lebih aman (tidak root)
- Implementasikan rate limiting untuk login attempt
- Tambahkan Two-Factor Authentication jika diperlukan
