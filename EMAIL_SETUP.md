# 📧 Email Notification Setup

## Apa yang sudah diimplementasikan:

✅ Email notification saat request submit  
✅ Plain text format email  
✅ Admin menerima email dengan detail request  
✅ Link ke admin dashboard di dalam email  
✅ Error handling jika email gagal dikirim  

---

## Setup SMTP Credentials

Untuk mengirim email, Anda perlu menggunakan SMTP service. Berikut pilihan yang tersedia:

### **Option 1: Mailtrap (Recommended untuk Testing)**

1. Buka https://mailtrap.io
2. Sign up (gratis)
3. Buat project/inbox baru
4. Copy credentials dari "Integrations" → "Laravel 11"
5. Update `.env` file:

```
MAIL_MAILER=smtp
MAIL_SCHEME=tls
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=<paste dari Mailtrap>
MAIL_PASSWORD=<paste dari Mailtrap>
MAIL_FROM_ADDRESS="noreply@vale.example.com"
MAIL_FROM_NAME="Request Management System"
```

### **Option 2: Gmail SMTP**

1. Enable 2-Factor Authentication di Google Account Anda
2. Generate App Password: https://myaccount.google.com/apppasswords
3. Copy app password yang dihasilkan
4. Update `.env`:

```
MAIL_MAILER=smtp
MAIL_SCHEME=tls
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=<16-char app password>
MAIL_FROM_ADDRESS="your-email@gmail.com"
MAIL_FROM_NAME="Request Management System"
```

### **Option 3: Menggunakan Email Provider Perusahaan**

Tanyakan IT department untuk:
- SMTP Host
- SMTP Port (biasanya 587 atau 465)
- Username dan Password
- TLS/SSL protocol

---

## Mengubah Email Admin

Email admin yang menerima notifikasi dapat diubah di file:
`app/Http/Controllers/RequestController.php`

Cari baris:
```php
$adminEmail = 'admin@vale.example.com';
```

Ganti `admin@vale.example.com` dengan email admin yang sebenarnya.

---

## Testing Email

Setelah setup SMTP credentials, coba submit request baru. Email seharusnya terkirim ke inbox admin.

Jika menggunakan Mailtrap, email akan terlihat di Mailtrap dashboard (tidak ke real email).

---

## Format Email yang Dikirim

```
New Request Submitted
======================

A new request has been submitted and is waiting for your review.

REQUEST DETAILS:
Request Name: [nama request]
Badge Number: [nomor badge]
Category: [kategori]
Status: pending
Submitted Date: [tanggal submit]

DESCRIPTION:
[isi deskripsi]

ADMIN ACTIONS:
Untuk review request, kunjungi:
[Link ke Admin Dashboard]
```

---

## Troubleshooting

### Email tidak terkirim?
1. Cek `.env` file, pastikan MAIL settings benar
2. Cek Laravel logs: `storage/logs/laravel.log`
3. Jika pakai Mailtrap, cek dashboard Mailtrap

### Error "Connection refused"?
- Pastikan SMTP Host dan Port benar
- Jika pakai Gmail, pastikan app password (bukan regular password)
- Jika pakai corporate email, contact IT untuk SMTP settings

### Error "Authentication failed"?
- Username dan Password salah
- Sudah di-copy dengan benar dari provider?
- Ada spasi ekstra?

---

## Next Steps

Setelah email berfungsi, bisa tambahkan:
- Email notification saat status request berubah
- Attach file PDF dengan detail request
- Custom branding/logo di email
- Email templates dalam HTML format
