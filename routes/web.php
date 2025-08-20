<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\AdminController;
use App\Models\Login;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\DailyActivityController;
use App\Http\Controllers\TempatPklController;

// Buat akun testing
Route::get('/buat-admin', function () {
    if (!Login::where('id_login', 'admin')->exists()) {
        Login::create([
            'id_login' => 'admin',
            'password' => Hash::make('123'),
            'role' => 'admin'
        ]);
        return 'Akun admin berhasil dibuat!';
    }

    return 'Akun admin sudah ada!';
});

// Login
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin routes
Route::middleware(['cekrole:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])
        ->name('admin.dashboard');

    // CRUD Guru
    Route::get('/admin/guru', [GuruController::class, 'index'])->name('admin.guru.index');
    Route::get('/admin/guru/create', [GuruController::class, 'create'])->name('admin.guru.create');
    Route::post('/admin/guru', [GuruController::class, 'store'])->name('admin.guru.store');
    Route::get('/admin/guru/{guru}/edit', [GuruController::class, 'edit'])->name('admin.guru.edit');
    Route::put('/admin/guru/{guru}', [GuruController::class, 'update'])->name('admin.guru.update');
    Route::delete('/admin/guru/{guru}', [GuruController::class, 'destroy'])->name('admin.guru.destroy');


    // CRUD Siswa
    Route::get('/admin/siswa', [SiswaController::class, 'index'])->name('admin.siswa.index');
    Route::get('/admin/siswa/create', [SiswaController::class, 'create'])->name('admin.siswa.create');
    Route::post('/admin/siswa', [SiswaController::class, 'store'])->name('admin.siswa.store');
    Route::get('/admin/siswa/{id}/edit', [SiswaController::class, 'edit'])->name('admin.siswa.edit');
    Route::put('/admin/siswa/{id}', [SiswaController::class, 'update'])->name('admin.siswa.update');
    Route::delete('/admin/siswa/{id}', [SiswaController::class, 'destroy'])->name('admin.siswa.destroy');
});

Route::middleware(['cekrole:guru'])->group(function () {
    Route::get('/guru/dashboard', [GuruController::class, 'dashboard'])->name('guru.dashboard');
    Route::get('/guru/siswa/{id}', [GuruController::class, 'showSiswa'])->name('guru.siswa.show');

    Route::get('/guru/siswa/{id}/tempat', [GuruController::class, 'showTempat'])->name('guru.siswa.tempat');
    Route::get('/guru/siswa/{id}/activity', [GuruController::class, 'showActivity'])->name('guru.siswa.activity');
});

Route::middleware(['cekrole:siswa'])->group(function () {
    Route::get('/siswa/dashboard', [SiswaController::class, 'dashboard'])->name('siswa.dashboard');
});

Route::prefix('siswa/tempat')->group(function() {
    Route::get('/', [TempatPKLController::class, 'index'])->name('siswa.tempat.index');
    Route::get('/create', [TempatPKLController::class, 'create'])->name('siswa.tempat.create');
    Route::post('/store', [TempatPKLController::class, 'store'])->name('siswa.tempat.store');
    Route::get('/{id}/edit', [TempatPKLController::class, 'edit'])->name('siswa.tempat.edit');
    Route::put('/{id}/update', [TempatPKLController::class, 'update'])->name('siswa.tempat.update');
});
Route::prefix('siswa/activity')->group(function() {
    Route::get('/', [DailyActivityController::class, 'index'])->name('siswa.activity.index');
    Route::get('/create', [DailyActivityController::class, 'create'])->name('siswa.activity.create');
    Route::post('/store', [DailyActivityController::class, 'store'])->name('siswa.activity.store');
    Route::get('/{id}/edit', [DailyActivityController::class,'edit'])->name('siswa.activity.edit');
    Route::put('/{id}/update', [DailyActivityController::class,'update'])->name('siswa.activity.update');
    Route::delete('/{id}/destroy', [DailyActivityController::class, 'destroy'])->name('siswa.activity.destroy');
});
