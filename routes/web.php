<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicRegistrationController;
use App\Http\Controllers\PublicContactController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\RegistrationController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

/* ========================================
   PUBLIC ROUTES
   ======================================== */

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang', [HomeController::class, 'about'])->name('about');
Route::get('/berita', [HomeController::class, 'berita'])->name('berita');
Route::get('/berita/{slug}', [HomeController::class, 'beritaDetail'])->name('berita.detail');

// PPDB Online
Route::get('/ppdb', [HomeController::class, 'ppdb'])->name('ppdb');
Route::post('/ppdb', [PublicRegistrationController::class, 'store'])->name('ppdb.store');

// Kontak
Route::get('/kontak', [HomeController::class, 'contact'])->name('contact');
Route::post('/kontak', [PublicContactController::class, 'store'])->name('contact.store');

/* ========================================
   ADMIN ROUTES
   ======================================== */

Route::prefix('admin')->name('admin.')->group(function () {

    // 1. AUTH ROUTES (Login)
    // Tidak boleh dibungkus middleware 'auth', karena user belum login saat mengakses halaman ini.
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // 2. ROUTES UNTUK ADMIN & PENULIS (Authenticated)
    // Menggunakan middleware 'auth' saja.
    // Artinya: Siapapun yang login (baik role 'admin' maupun 'penulis') bisa mengakses route di bawah ini.
    Route::middleware(['auth'])->group(function () {

        // Logout (Semua user yang login wajib bisa logout)
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // Dashboard (Penulis & Admin bisa akses)
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // --- KONTEN (Penulis & Admin bisa akses) ---
        
        // CRUD Posts (Berita)
        Route::resource('posts', PostController::class);

        // CRUD Galleries
        Route::resource('galleries', GalleryController::class);

        // CRUD Programs
        Route::resource('programs', ProgramController::class);

        // 3. ROUTES KHUSUS ADMIN (Admin Only)
        // Di dalam grup auth, kita buat grup baru yang menggunakan middleware 'admin'.
        // Artinya: Hanya user yang role-nya 'admin' yang bisa mengakses route di bawah ini.
        Route::middleware(['admin'])->group(function () {
            
            // CRUD Teachers (Hanya Admin)
            Route::resource('teachers', TeacherController::class);

            // Registrations PPDB (Hanya Admin)
            Route::resource('registrations', RegistrationController::class)->only(['index', 'show', 'update', 'destroy']);
            Route::post('registrations/export', [RegistrationController::class, 'export'])->name('registrations.export');

            // Contacts/Pesan Masuk (Hanya Admin)
            Route::resource('contacts', ContactController::class)->only(['index', 'show', 'destroy']);
            Route::post('contacts/mark-all-read', [ContactController::class, 'markAllRead'])->name('contacts.mark-all-read');

            // Settings/Pengaturan (Hanya Admin)
            Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
            Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
            
        });
    });
});