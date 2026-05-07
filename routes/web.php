<?php

use Illuminate\Support\Facades\Route;
use App\Services\SettingService;

// Import Controllers (Namespace Lengkap)
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicRegistrationController;
use App\Http\Controllers\PublicContactController;
use App\Http\Controllers\CheckStatusController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\RegistrationController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\SettingController;

// Import Middleware (Namespace Lengkap)
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\IsSpmbMiddleware;

/* ========================================
   PUBLIC ROUTES
   ======================================== */

// Cek Status
Route::get('/cek-status', [CheckStatusController::class, 'show'])->name('cek-status');
Route::post('/cek-status/check', [CheckStatusController::class, 'check'])->name('cek-status.check');
Route::get('/cek-status/pdf', [CheckStatusController::class, 'downloadPdf'])->name('cek-status.pdf');

// Halaman Depan
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang', [HomeController::class, 'about'])->name('about');
Route::get('/berita', [HomeController::class, 'berita'])->name('berita');
Route::get('/berita/{slug}', [HomeController::class, 'beritaDetail'])->name('berita.detail');

// SPMB Group
Route::prefix('spmb')->group(function () {
    Route::get('/', function () {
        if (app(SettingService::class)->get('spmb_disabled') === '1') {
            return view('pages.spmb-closed');
        }
        return app(HomeController::class)->spmb();
    })->name('spmb');

    Route::post('/store', function (\Illuminate\Http\Request $request) {
        if (app(SettingService::class)->get('spmb_disabled') === '1') {
            abort(403, 'Pendaftaran sudah ditutup.');
        }
        return app(PublicRegistrationController::class)->store($request);
    })->name('spmb.store');
});

// Kontak
Route::get('/kontak', [HomeController::class, 'contact'])->name('contact');
Route::post('/kontak', [PublicContactController::class, 'store'])->name('contact.store');

/* ========================================
   ADMIN ROUTES
   ======================================== */

Route::prefix('admin')->name('admin.')->group(function () {

    // 1. AUTH ROUTES (Login)
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // 2. PROTECTED ROUTES (Wajib Login)
    // Menggunakan Class Middleware untuk memastikan path benar
    Route::middleware([AdminMiddleware::class])->group(function () {

        // Logout
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // Dashboard (Semua role: admin, penulis, spmb)
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // --- GRUP KONTEN (Admin & Penulis) ---
        // Menggunakan Class Middleware CheckRole dengan parameter 'admin,penulis'
        Route::middleware([CheckRole::class . ':admin,penulis'])->group(function () {
            
            Route::resource('posts', PostController::class);
            Route::resource('galleries', GalleryController::class);
            Route::resource('programs', ProgramController::class);

            // --- KATEGORI ---
            Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
            Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
            Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

            // --- SUB-GRUP KONTEN KHUSUS ADMIN ---
            // Di dalam grup konten, kita cek lagi role untuk menu khusus admin
            Route::middleware([AdminMiddleware::class])->group(function () {
                Route::resource('teachers', TeacherController::class);
                Route::resource('contacts', ContactController::class)->only(['index', 'show', 'destroy']);
                Route::post('contacts/mark-all-read', [ContactController::class, 'markAllRead'])->name('contacts.mark-all-read');
                Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
                Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
            });
        });

        // --- GRUP SPMB (Admin & Panitia SPMB) ---
        // Menggunakan Class Middleware IsSpmbMiddleware
        Route::middleware([IsSpmbMiddleware::class])->group(function () {
            Route::resource('registrations', RegistrationController::class)->only(['index', 'show', 'update', 'destroy']);
            
            Route::post('registrations/export', [RegistrationController::class, 'export'])->name('registrations.export');
            Route::post('registrations/export-pdf', [RegistrationController::class, 'exportPdf'])->name('registrations.export-pdf');
            Route::post('registrations/verify-documents/{id}', [RegistrationController::class, 'verifyDocuments'])->name('registrations.verify-documents');
        });

    });
});