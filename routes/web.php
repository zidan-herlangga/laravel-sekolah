<?php

use Illuminate\Support\Facades\Route;
use App\Services\SettingService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

// --- Controller Publik & Pendaftar ---
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicRegistrationController;
use App\Http\Controllers\PublicContactController;
use App\Http\Controllers\CheckStatusController;
use App\Http\Controllers\UjianController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// --- Controller Admin ---
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\RegistrationController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ExampController;

// --- Middleware ---
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\IsSpmbMiddleware;



/*
|--------------------------------------------------------------------------
| LANDING PAGE & PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang', [HomeController::class, 'about'])->name('about');
Route::get('/berita', [HomeController::class, 'berita'])->name('berita');
Route::get('/berita/{slug}', [HomeController::class, 'beritaDetail'])->name('berita.detail');
Route::get('/kontak', [HomeController::class, 'contact'])->name('contact');
Route::post('/kontak', [PublicContactController::class, 'store'])->name('contact.store');

/*
|--------------------------------------------------------------------------
| EMAIL VERIFICATION ROUTES
|--------------------------------------------------------------------------
*/

// UBAH DARI verification.send MENJADI verification.notice
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// Rute untuk memproses verifikasi (saat link diklik)
Route::get('/email/verify/{id}/{hash}', function (\Illuminate\Foundation\Auth\EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('dashboard')->with('success', 'Email berhasil diverifikasi!');
})->middleware(['auth', 'signed'])->name('verification.verify');

// Rute untuk mengirim ulang email (ini yang cocok dinamai verification.send)
Route::post('/email/verification-notification', function (Illuminate\Http\Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Link verifikasi baru telah dikirim.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

/*
|--------------------------------------------------------------------------
| AUTHENTICATION (GUEST ONLY)
|--------------------------------------------------------------------------
| Mencegah user yang sudah login (Admin/User) untuk kembali ke halaman login.
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| DASHBOARD & SPMB ROUTES (PENDAFTAR / ROLE: USER)
|--------------------------------------------------------------------------
*/
Route::prefix('spmb')->group(function () {
    // Hanya user dengan role 'user' yang bisa akses bagian ini
    Route::middleware(['auth', 'verified', CheckRole::class . ':user'])->group(function () {
        
        Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
        Route::get('/profil', [HomeController::class, 'profile'])->name('pendaftar.profile');
        Route::get('/download-bukti', [PublicRegistrationController::class, 'downloadBukti'])->name('pendaftar.download');
        Route::get('/download-kartu', [PublicRegistrationController::class, 'downloadKartu'])->name('pendaftar.kartu');

        // Cek Status Pendaftaran
        Route::get('/cek-status', [CheckStatusController::class, 'show'])->name('pendaftar.cek-status');
        Route::post('/cek-status', [CheckStatusController::class, 'check'])->name('pendaftar.cek-status.check');
        Route::get('/cek-status/pdf', [CheckStatusController::class, 'downloadPdf'])->name('pendaftar.cek-status.pdf');

        // Fitur CBT (Ujian Online)
        Route::get('/ujian', [UjianController::class, 'index'])->name('pendaftar.ujian.index');
        Route::get('/ujian/start', [UjianController::class, 'start'])->name('pendaftar.ujian.start');
        Route::post('/ujian/submit', [UjianController::class, 'submit'])->name('pendaftar.ujian.submit');

        // Payment
        Route::get('/payment', [App\Http\Controllers\PaymentController::class, 'index'])->name('payment.index');
        Route::post('/payment/create', [App\Http\Controllers\PaymentController::class, 'create'])->name('payment.create');
        Route::get('/payment/success', [App\Http\Controllers\PaymentController::class, 'success'])->name('payment.success');
        Route::get('/payment/unfinish', [App\Http\Controllers\PaymentController::class, 'unfinish'])->name('payment.unfinish');
        Route::get('/payment/error', [App\Http\Controllers\PaymentController::class, 'error'])->name('payment.error');
        Route::get('/payment/invoice', [App\Http\Controllers\PaymentController::class, 'downloadInvoice'])->name('payment.invoice');

        // Form Pendaftaran
        Route::get('/', [HomeController::class, 'spmb'])->name('spmb');

        Route::post('/store', [PublicRegistrationController::class, 'store'])->name('pendaftar.spmb.store');
    });
});

// Midtrans Callback (no auth)
Route::post('/payment/callback', [App\Http\Controllers\PaymentController::class, 'callback'])->name('payment.callback');
    

/*
|--------------------------------------------------------------------------
| ADMIN PANEL ROUTES (ROLE: ADMIN, SPMB, PENULIS)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {

    // Login khusus admin (jika ingin dipisah dari login user)
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login']);
    });

    // Grup Middleware Keamanan Admin
    Route::middleware([AdminMiddleware::class])->group(function () {
        
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // 1. Grup Konten (Admin & Penulis)
            Route::middleware([CheckRole::class . ':admin,penulis'])->group(function () {
                Route::resource('posts', PostController::class);
                Route::post('posts/bulk-delete', [PostController::class, 'bulkDelete'])->name('posts.bulk-delete');
                Route::resource('galleries', GalleryController::class);
                Route::post('galleries/bulk-delete', [GalleryController::class, 'bulkDelete'])->name('galleries.bulk-delete');
                Route::resource('programs', ProgramController::class);
                Route::post('programs/bulk-delete', [ProgramController::class, 'bulkDelete'])->name('programs.bulk-delete');
                Route::resource('categories', CategoryController::class)->except(['show', 'edit', 'update']);
                Route::post('categories/bulk-delete', [CategoryController::class, 'bulkDelete'])->name('categories.bulk-delete');

                // 2. Grup Khusus Root Admin (Settings & Guru)
                Route::middleware([CheckRole::class . ':admin'])->group(function () {
                    Route::resource('teachers', TeacherController::class);
                    Route::post('teachers/bulk-delete', [TeacherController::class, 'bulkDelete'])->name('teachers.bulk-delete');
                    Route::resource('contacts', ContactController::class)->only(['index', 'show', 'destroy']);
                    Route::post('contacts/bulk-delete', [ContactController::class, 'bulkDelete'])->name('contacts.bulk-delete');
                    Route::post('contacts/mark-all-read', [ContactController::class, 'markAllRead'])->name('contacts.mark-all-read');
                    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
                    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
                });
            });

        // 3. Grup SPMB & EXAMP (Admin & Panitia/Staff SPMB)
        Route::middleware([IsSpmbMiddleware::class])->group(function () {
            
            Route::resource('registrations', RegistrationController::class);
            Route::post('registrations/verify/{id}', [RegistrationController::class, 'verifyDocuments'])->name('registrations.verify-documents');
            Route::post('registrations/{registration}/update-payment', [RegistrationController::class, 'updatePayment'])->name('registrations.update-payment');
            Route::post('registrations/export/', [RegistrationController::class, 'export'])->name('registrations.export');
            Route::post('registrations/export-pdf/', [RegistrationController::class, 'exportPdf'])->name('registrations.export-pdf');
            Route::post('registrations/bulk-delete', [RegistrationController::class, 'bulkDelete'])->name('registrations.bulk-delete');

            // Data Pembayaran
            Route::prefix('payments')->name('payments.')->group(function () {
                Route::get('/', [\App\Http\Controllers\Admin\PaymentController::class, 'index'])->name('index');
                Route::post('export', [\App\Http\Controllers\Admin\PaymentController::class, 'exportCsv'])->name('export');
                Route::post('export-pdf', [\App\Http\Controllers\Admin\PaymentController::class, 'exportPdf'])->name('export-pdf');
                Route::delete('{id}', [\App\Http\Controllers\Admin\PaymentController::class, 'destroy'])->name('destroy');
                Route::post('bulk-delete', [\App\Http\Controllers\Admin\PaymentController::class, 'bulkDelete'])->name('bulk-delete');
                Route::get('/{id}', [\App\Http\Controllers\Admin\PaymentController::class, 'show'])->name('show');
            });

            // Fitur CBT (Examp)
            Route::prefix('examp')->name('examp.')->group(function() {
                Route::get('/', [ExampController::class, 'index'])->name('index');
                Route::get('/create', [ExampController::class, 'create'])->name('create');
                Route::get('/{id}/edit', [ExampController::class, 'edit'])->name('edit');
                Route::put('/{id}', [ExampController::class, 'update'])->name('update');
                Route::post('/store', [ExampController::class, 'store'])->name('store');
                Route::get('/results', [ExampController::class, 'results'])->name('results');
                Route::delete('/{id}', [ExampController::class, 'destroy'])->name('destroy');
                Route::post('/bulk-delete', [ExampController::class, 'bulkDelete'])->name('bulk-delete');
            });
        });
    });
});