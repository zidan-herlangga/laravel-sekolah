<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicRegistrationController;
use App\Http\Controllers\PublicContactController;
use App\Http\Controllers\CheckStatusController;
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
use App\Services\SettingService;

/* ========================================
   PUBLIC ROUTES
   ======================================== */

Route::get('/cek-status', [CheckStatusController::class, 'show'])->name('cek-status');
Route::post('/cek-status/check', [CheckStatusController::class, 'check'])->name('cek-status.check');
// Route Download PDF Bukti Pendaftaran
Route::get('/cek-status/pdf', [CheckStatusController::class, 'downloadPdf'])->name('cek-status.pdf');


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang', [HomeController::class, 'about'])->name('about');
Route::get('/berita', [HomeController::class, 'berita'])->name('berita');
Route::get('/berita/{slug}', [HomeController::class, 'beritaDetail'])->name('berita.detail');

// --- SPMB Group (Pendaftaran) ---
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

    // 2. GROUP ADMIN AREA (Wajib Auth)
    Route::middleware(['auth'])->group(function () {

        // Logout
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // Dashboard (Semua role: admin, penulis, spmb)
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::post('registrations/verify-documents/{id}', [RegistrationController::class, 'verifyDocuments'])->name('registrations.verify-documents');

        // --- GRUP KONTEN (Admin & Penulis) ---
        // Menggunakan Middleware String 'check.role:admin,penulis'
        Route::middleware('check.role:admin,penulis')->group(function () {
            Route::resource('posts', PostController::class);
            Route::resource('galleries', GalleryController::class);
            Route::resource('programs', ProgramController::class);
            
            // Sub-Grup Khusus Admin (di dalam Konten)
            Route::middleware('check.role:admin')->group(function () {
                Route::resource('teachers', TeacherController::class);
                Route::resource('contacts', ContactController::class)->only(['index', 'show', 'destroy']);
                Route::post('contacts/mark-all-read', [ContactController::class, 'markAllRead'])->name('contacts.mark-all-read');
                Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
                Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
            });
        });

        // --- GRUP SPMB (Admin & SPMB) ---
        // Menggunakan Middleware String 'is.spmb'
        Route::middleware('is.spmb')->group(function () {
            // TAMBAHKAN 'destroy' KE DALAM ARRAY ONLY()
            Route::resource('registrations', RegistrationController::class)->only(['index', 'show', 'update', 'destroy']);
            
            Route::post('registrations/export', [RegistrationController::class, 'export'])->name('registrations.export');
            Route::post('registrations/export-pdf', [RegistrationController::class, 'exportPdf'])->name('registrations.export-pdf');
            Route::post('registrations/verify-documents/{id}', [RegistrationController::class, 'verifyDocuments'])->name('registrations.verify-documents');

            Route::resource('contacts', ContactController::class)->only(['index', 'show', 'destroy']);
            Route::post('contacts/mark-all-read', [ContactController::class, 'markAllRead'])->name('contacts.mark-all-read');

            Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
            Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
        });

    });
});