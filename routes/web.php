<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\UserReportsController;
use App\Http\Controllers\AdminReportsController;
// use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ScheduleController as AdminScheduleController;
use App\Http\Controllers\ScheduleController as UserScheduleController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\UserPaymentController;
use App\Http\Controllers\AdminPaymentController;

// ======================== PUBLIC ========================
Route::get('/', fn() => view('welcome'));

// Route::get('/schedule/events', [ScheduleController::class, 'events']);
// Route::get('/admin/schedule/events', [ScheduleController::class, 'events']);

Route::get('/schedule/events', [UserScheduleController::class, 'events'])
    ->name('schedule.events');

// ======================= REDIRECT SETELAH LOGIN =======================
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ======================= PROFILE (SEMUA USER) ======================
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ===============================================================
//                           ADMIN ROUTES
// ===============================================================
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard Admin
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // admin payments
        // Route::get('/payments', fn() => view('admin.payments'))->name('payments');
        // Route::middleware(['auth','admin'])->group(function () {
        //     Route::get('/admin/payments', [AdminPaymentController::class, 'index'])->name('admin.payments');
        //     Route::patch('/admin/payments/{payment}', [AdminPaymentController::class, 'update'])->name('admin.payments.update');
        // });
        Route::get('/payments', [AdminPaymentController::class, 'index'])
            ->name('payments.index');

        Route::patch('/payments/{payment}', [AdminPaymentController::class, 'update'])
            ->name('payments.update');

        // Reports Admin
        Route::get('/reports', [AdminReportsController::class, 'index'])->name('reports');
        Route::post('/reports/{report}/confirm', [AdminReportsController::class, 'confirm'])->name('reports.confirm');
        Route::post('/reports/{report}/reject', [AdminReportsController::class, 'reject'])->name('reports.reject');

        // User Management
        Route::get('/usermanagement', [UserManagementController::class, 'index'])->name('usermanagement');
        Route::get('/users/create', [UserManagementController::class, 'create'])->name('users.create');
        Route::post('/users', [UserManagementController::class, 'store'])->name('users.store');
        Route::get('/users/{id}/edit', [UserManagementController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}', [UserManagementController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [UserManagementController::class, 'destroy'])->name('users.destroy');

        // Schedule Admin
        Route::get('/schedule', [AdminScheduleController::class, 'index'])->name('schedule.index');
        Route::get('/schedule/create', [AdminScheduleController::class, 'create'])->name('schedule.create');
        Route::post('/schedule', [AdminScheduleController::class, 'store'])->name('schedule.store');
        // Route::get('/schedule/{schedule}/edit', [AdminScheduleController::class, 'edit'])->name('schedule.edit');
        Route::get('/schedule/{id}/edit', [AdminScheduleController::class, 'edit'])->name('schedule.edit');
        Route::put('/schedule/{schedule}', [AdminScheduleController::class, 'update'])->name('schedule.update');
        Route::delete('/schedule/{schedule}', [AdminScheduleController::class, 'destroy'])->name('schedule.destroy');
        Route::get('/schedule/events', [AdminScheduleController::class, 'events'])->name('schedule.events');
});

// ===============================================================
//                           USER ROUTES
// ===============================================================
Route::middleware(['auth', 'user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

        // Schedule
        Route::get('/schedule', fn() => view('user.schedule'))->name('schedule');

        //  // Payment (STEP 1–3)
        // Route::get('/payments', [UserPaymentController::class, 'index'])
        //     ->name('payments.index'); // Step 1: pilih metode

        // Route::post('/payments/confirm', [UserPaymentController::class, 'confirm'])
        //     ->name('payments.confirm'); // Step 2: tampilkan rekening

        // Route::post('/payments/upload', [UserPaymentController::class, 'upload'])
        //     ->name('payments.upload'); // Step 3: upload bukti

        // Route::get('/user/payments/confirm', [UserPaymentController::class, 'showConfirm'])
        //     ->name('user.payments.confirm.show');

        // // Payment History
        // Route::get('/payments/history', [UserPaymentController::class, 'history'])
        //     ->name('payments.history');
        // Payment Step 1–3
Route::get('/payments', [UserPaymentController::class, 'index'])
    ->name('payments.index');

// POST: ketika user pilih metode pembayaran
Route::post('/payments/confirm', [UserPaymentController::class, 'confirm'])
    ->name('payments.confirm');

// GET: menampilkan halaman konfirmasi pembayaran
Route::get('/payments/confirm', [UserPaymentController::class, 'showConfirm'])
    ->name('payments.confirm.show');

// Upload bukti pembayaran
Route::post('/payments/upload', [UserPaymentController::class, 'upload'])
    ->name('payments.upload');

// History pembayaran
Route::get('/payments/history', [UserPaymentController::class, 'history'])
    ->name('payments.history');

        // User Reports CRUD
        Route::get('/reports', [UserReportsController::class, 'index'])->name('reports.index');
        Route::get('/reports/create', [UserReportsController::class, 'create'])->name('reports.create');
        Route::post('/reports', [UserReportsController::class, 'store'])->name('reports.store');
        Route::get('/reports/{report}/edit', [UserReportsController::class, 'edit'])->name('reports.edit');
        Route::put('/reports/{report}', [UserReportsController::class, 'update'])->name('reports.update');
        Route::delete('/reports/{report}', [UserReportsController::class, 'destroy'])->name('reports.destroy');
});

// ======================= AUTH =======================
require __DIR__ . '/auth.php';
