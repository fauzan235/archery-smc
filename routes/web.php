<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StructureController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthController;

// =============================================
// PUBLIC ROUTES (No Auth Required)
// =============================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kepengurusan', [StructureController::class, 'index'])->name('structure.index');

// =============================================
// GUEST ONLY (redirect if already logged in)
// =============================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/login/demo/{role}', [AuthController::class, 'quickLogin'])->name('login.demo');
});

// =============================================
// AUTH REQUIRED (All logged-in users can view)
// =============================================
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Anggota — semua user bisa lihat daftar
    Route::get('/anggota', [MemberController::class, 'index'])->name('members.index');

    // Absensi — semua user bisa lihat
    Route::get('/absensi', [AttendanceController::class, 'index'])->name('attendances.index');

    // Iuran — semua user bisa lihat
    Route::get('/iuran', [FinanceController::class, 'index'])->name('finances.index');

    // Jadwal — semua user bisa lihat
    Route::get('/jadwal', [ScheduleController::class, 'index'])->name('schedules.index');
});

// =============================================
// ADMIN ONLY (role = admin)
// =============================================
Route::middleware(['auth', 'admin'])->group(function () {
    // Admin Dashboard
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Anggota CRUD (Admin only)
    Route::post('/anggota', [MemberController::class, 'store'])->name('members.store');
    Route::put('/anggota/{member}', [MemberController::class, 'update'])->name('members.update');
    Route::delete('/anggota/{member}', [MemberController::class, 'destroy'])->name('members.destroy');
    Route::get('/anggota/export', [MemberController::class, 'export'])->name('members.export');

    // Absensi CRUD (Admin only)
    Route::post('/absensi', [AttendanceController::class, 'store'])->name('attendances.store');
    Route::delete('/absensi/{attendance}', [AttendanceController::class, 'destroy'])->name('attendances.destroy');
    Route::get('/absensi/export', [AttendanceController::class, 'export'])->name('attendances.export');

    // Iuran CRUD (Admin only)
    Route::post('/iuran', [FinanceController::class, 'store'])->name('finances.store');
    Route::post('/iuran/{member}/mark-paid', [FinanceController::class, 'markPaid'])->name('finances.markPaid');
    Route::get('/iuran/export', [FinanceController::class, 'export'])->name('finances.export');

    // Jadwal CRUD (Admin only)
    Route::post('/jadwal', [ScheduleController::class, 'store'])->name('schedules.store');
    Route::put('/jadwal/{schedule}', [ScheduleController::class, 'update'])->name('schedules.update');
    Route::delete('/jadwal/{schedule}', [ScheduleController::class, 'destroy'])->name('schedules.destroy');
});
