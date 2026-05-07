## 🚀 Panduan Instalasi

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek di lingkungan lokal Anda:

### 1. Prasyarat

Pastikan sistem Anda sudah terpasang:

- PHP >= 8.2.
- Composer
- Database (MySQL / MariaDB / PostgreSQL)

### 2. Langkah-Langkah

1.  **Clone Repositori**

    ```bash
    git clone https://github.com/zidan-herlangga/laravel-sekolah.git
    cd laravel-sekolah
    ```

2.  **Konfigurasi Environment**
    Salin file `.env.example` menjadi `.env` dan sesuaikan pengaturan database Anda:

    ```bash
    cp .env.example .env
    ```

3.  **Optimasi Aplikasi**

    ```bash
    php artisan key:generate
    php artisan storage:link
    ```

4.  **Migrasi Database**
    Pastikan database kosong telah dibuat, lalu jalankan:

    ```bash
    php artisan migrate --seed
    ```

5.  **Jalankan Server**
    ```bash
    php artisan serve
    ```
    Aplikasi Anda sekarang dapat diakses melalui [http://localhost:8000](http://localhost:8000).Tentu, mari kita susun ulang dokumentasi `README.md` Anda agar terlihat lebih profesional, terstruktur, dan mudah dipahami oleh pengembang lain.
