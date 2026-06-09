# Laravel Sekolah — SPMB Online

Aplikasi **Penerimaan Siswa Baru (SPMB)** berbasis web dengan ujian online (CBT) dan pembayaran integrasi Midtrans.

---

## Fitur

### Publik
- Landing page sekolah (profil, berita, galeri, guru, program unggulan)
- Form pendaftaran SPMB dengan upload dokumen (KK, Ijazah, Akte)
- Cek status pendaftaran via NISN
- Halaman kontak

### Pendaftar
- Dashboard status pendaftaran & pembayaran
- **Ujian seleksi online (CBT)** — gratis, syarat cukup diverifikasi admin
- **Pembayaran daftar ulang** — dilakukan hanya setelah dinyatakan **Lulus**
- Download bukti pendaftaran, kartu peserta, invoice

### Admin
- Verifikasi dokumen pendaftar
- Atur jadwal ujian & pengumuman kelulusan
- **Bulk delete** data pada semua tabel
- Kelola soal CBT (bank soal)
- Lihat hasil ujian & nilai
- Atur biaya daftar ulang (manual / Midtrans)
- Kelola konten (berita, galeri, guru, program)
- Export data CSV / PDF
- Settings (buka/tutup SPMB, jadwal ujian, dll)

---

## Alur Sistem

```
1. Pendaftar buat akun → Isi form SPMB
2. Admin verifikasi dokumen → status "Terverifikasi"
3. Pendaftar ikut ujian online (GRATIS)
4. Admin tentukan kelulusan → "Lulus" / "Tidak Lulus"
5. Jika Lulus → Pembayaran daftar ulang (Manual / Midtrans)
```

> **Ujian gratis**: Tidak perlu bayar untuk ikut ujian. Cukup dokumen diverifikasi admin.

---

## Instalasi

### Prasyarat

- PHP >= 8.2
- Composer 2.x
- MySQL / MariaDB
- Laragon / XAMPP (opsional)

### Langkah

```bash
# Clone repositori
git clone https://github.com/zidan-herlangga/laravel-sekolah.git
cd laravel-sekolah

# Install dependensi
composer install
npm install && npm run build

# Konfigurasi environment
cp .env.example .env
php artisan key:generate
php artisan storage:link

# Buat database lalu migrasi
php artisan migrate --seed

# Jalankan
php artisan serve
```

Akses di `http://localhost:8000`.

---

## Konfigurasi

### Database

Atuh di `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_sekolah
DB_USERNAME=root
DB_PASSWORD=
```

### Midtrans (Pembayaran Otomatis)

Daftar akun [Midtrans](https://midtrans.com), dapatkan *Server Key* & *Client Key* (mode sandbox/production):

```env
MIDTRANS_SERVER_KEY=SB-Mid-server-xxx
MIDTRANS_CLIENT_KEY=SB-Mid-client-xxx
MIDTRANS_IS_PRODUCTION=false
```

#### SSL di Localhost

Jika muncul error `SSL certificate problem: unable to get local issuer certificate`, set `curl.cainfo` di `php.ini`:

```ini
[curl]
curl.cainfo = "C:/laragon/etc/ssl/cacert.pem"
```

Restart web server.

### Email Verifikasi

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=xxx
MAIL_PASSWORD=xxx
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@sekolah.test
MAIL_FROM_NAME="SMP Tunas Harapan"
```

---

## Admin Panel

| URL | `/admin/login` |
|-----|----------------|
| Default akun (seed) | `admin@sekolah.test` / `password` |
| Role | `admin`, `spmb`, `penulis` |

### Menu Admin

| Menu | Keterangan |
|------|-----------|
| Dashboard | Ringkasan data |
| Data Pendaftar | Verifikasi, kelulusan, atur biaya daftar ulang |
| Data Pembayaran | Riwayat transaksi Midtrans & manual |
| Bank Soal CBT | CRUD soal ujian |
| Hasil Ujian | Lihat nilai peserta |
| Kelola Berita | CRUD berita |
| Galeri Foto | CRUD galeri |
| Guru & Staff | CRUD guru/staff |
| Program Unggulan | CRUD program |
| Kategori | Kelola kategori berita |
| Pesan Masuk | Kontak dari pengunjung |
| Settings | Buka/tutup SPMB, jadwal ujian, info sekolah |

### Bulk Delete

Semua halaman tabel mendukung **bulk delete**:
1. Centang data yang ingin dihapus
2. Klik tombol **"Hapus Terpilih"** yang muncul
3. Konfirmasi

---

## API Pembayaran

### Midtrans (Otomatis)

- Admin set nominal biaya daftar ulang di detail pendaftar
- Setelah siswa dinyatakan **Lulus**, tombol "Bayar Sekarang" muncul
- Pembayaran via Snap popup (QRIS, Virtual Account, dll)
- Callback server-to-server otomatis update status

### Manual

- Admin langsung set status pembayaran ke **"Lunas (Manual)"** di detail pendaftar
- Tidak melibatkan payment gateway

---

## Troubleshooting

| Masalah | Solusi |
|---------|--------|
| SSL certificate error (Midtrans) | Set `curl.cainfo` di `php.ini` |
| "Undefined array key 10023" | Update vendor Midtrans atau gunakan `CURLOPT_SSL_VERIFYPEER => false` di development |
| Ujian tidak bisa diakses | Pastikan status pendaftar **"Terverifikasi"** |
| Pembayaran tidak muncul | Pastikan status pendaftar **"Lulus"** dan admin sudah set nominal biaya |
| Gambar tidak muncul | Jalankan `php artisan storage:link` |

---

## Teknologi

- **Laravel 11** — Backend
- **AdminLTE 3** — Admin panel
- **Midtrans Snap** — Payment gateway
- **CBT System** — Ujian online (timer, random soal, auto-score)
- **DomPDF** — Export PDF
- **Tailwind CSS** — Frontend publik
