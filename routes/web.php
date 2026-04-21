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

    // Auth (Dihapus middleware 'guest' dari sini)
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Protected routes
    Route::middleware(['auth', 'admin'])->group(function () {

        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // CRUD Posts
        Route::resource('posts', PostController::class);

        // CRUD Teachers
        Route::resource('teachers', TeacherController::class);

        // CRUD Galleries
        Route::resource('galleries', GalleryController::class);

        // CRUD Programs
        Route::resource('programs', ProgramController::class);

        // Registrations
        Route::resource('registrations', RegistrationController::class)->only(['index', 'show', 'update', 'destroy']);
        Route::post('registrations/export', [RegistrationController::class, 'export'])->name('registrations.export');

        // Contacts
        Route::resource('contacts', ContactController::class)->only(['index', 'show', 'destroy']);
        Route::post('contacts/mark-all-read', [ContactController::class, 'markAllRead'])->name('contacts.mark-all-read');

        // Settings
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
    });
});