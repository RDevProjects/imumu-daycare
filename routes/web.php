<?php

use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\ChildController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\FinanceReportController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PublicInvoiceController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public pages
Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/programs', [PageController::class, 'programs'])->name('programs');

// Registration (public)
Route::get('/daftar', [RegistrationController::class, 'create'])->name('daftar');
Route::post('/daftar', [RegistrationController::class, 'store'])->name('daftar.store');

// Parent history page (no login required)
Route::get('/riwayat/{token}', [HistoryController::class, 'show'])->name('riwayat');

// Public invoice (no login required)
Route::get('/invoice/{invoice:slug}', [PublicInvoiceController::class, 'show'])->name('public.invoice.show');

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post')->middleware('throttle:5,1');
});

// Authenticated routes (Admin)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Settings
    Route::get('/dashboard/pengaturan', [SettingsController::class, 'index'])->name('dashboard.pengaturan');
    Route::post('/dashboard/pengaturan', [SettingsController::class, 'update'])->name('dashboard.pengaturan.update');
    Route::post('/dashboard/pengaturan/profile', [SettingsController::class, 'updateAdminProfile'])->name('dashboard.pengaturan.profile');

    // Banks
    Route::post('/dashboard/banks', [BankController::class, 'store'])->name('dashboard.banks.store');
    Route::patch('/dashboard/banks/{bank}', [BankController::class, 'update'])->name('dashboard.banks.update');
    Route::delete('/dashboard/banks/{bank}', [BankController::class, 'destroy'])->name('dashboard.banks.destroy');
    Route::post('/dashboard/banks/{bank}/toggle', [BankController::class, 'toggleActive'])->name('dashboard.banks.toggle');

    // Packages
    Route::get('/dashboard/packages', [PackageController::class, 'index'])->name('dashboard.packages');
    Route::post('/dashboard/packages', [PackageController::class, 'store'])->name('dashboard.packages.store');
    Route::patch('/dashboard/packages/{package}', [PackageController::class, 'update'])->name('dashboard.packages.update');
    Route::delete('/dashboard/packages/{package}', [PackageController::class, 'destroy'])->name('dashboard.packages.destroy');
    Route::post('/dashboard/packages/{package}/toggle', [PackageController::class, 'toggleActive'])->name('dashboard.packages.toggle');

    // Children (Profile Anak)
    Route::get('/dashboard/profile-anak', [ChildController::class, 'index'])->name('dashboard.profile-anak');
    Route::post('/dashboard/profile-anak', [ChildController::class, 'store'])->name('dashboard.profile-anak.store');
    Route::patch('/dashboard/profile-anak/{child}', [ChildController::class, 'update'])->name('dashboard.profile-anak.update');

    // Payments — child calendar routes BEFORE {payment} wildcard
    Route::get('/dashboard/pembayaran/child/{child}', [PaymentController::class, 'showChildCalendar'])->name('dashboard.pembayaran.child');
    Route::post('/dashboard/pembayaran/child/{child}/store', [PaymentController::class, 'storeRecurring'])->name('dashboard.pembayaran.child.store');
    Route::get('/dashboard/pembayaran/child/{child}/wa-preview', [PaymentController::class, 'waPreview'])->name('dashboard.pembayaran.child.wa');

    Route::get('/dashboard/pembayaran', [PaymentController::class, 'index'])->name('dashboard.pembayaran');
    Route::get('/dashboard/pembayaran/{payment}/verify', [PaymentController::class, 'verify'])->name('dashboard.pembayaran.verify');
    Route::post('/dashboard/pembayaran/{payment}/mark-paid', [PaymentController::class, 'markAsPaid'])->name('dashboard.pembayaran.mark-paid');
    Route::post('/dashboard/pembayaran/{payment}/mark-cash', [PaymentController::class, 'markAsCash'])->name('dashboard.pembayaran.mark-cash');
    Route::post('/dashboard/pembayaran/{payment}/reject', [PaymentController::class, 'reject'])->name('dashboard.pembayaran.reject');

    // Finance Reports
    Route::get('/dashboard/reports/finance', [FinanceReportController::class, 'index'])->name('dashboard.reports.finance');
    Route::get('/dashboard/reports/finance/export', [FinanceReportController::class, 'export'])->name('dashboard.reports.finance.export');

    // Invoices (admin)
    Route::get('/dashboard/invoice/{invoice:slug}', [InvoiceController::class, 'show'])->name('dashboard.invoice.show');

    // Enrollments (Pendaftaran)
    Route::get('/dashboard/pendaftaran', [EnrollmentController::class, 'index'])->name('dashboard.pendaftaran');
    Route::post('/dashboard/pendaftaran/{enrollment}/confirm', [EnrollmentController::class, 'confirm'])->name('dashboard.pendaftaran.confirm');
    Route::post('/dashboard/pendaftaran/{enrollment}/reject', [EnrollmentController::class, 'reject'])->name('dashboard.pendaftaran.reject');
    Route::get('/dashboard/pendaftaran/{enrollment}/wa-message', [EnrollmentController::class, 'getWhatsAppMessage'])->name('dashboard.pendaftaran.wa');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
