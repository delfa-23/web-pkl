<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Models\Login;
use Illuminate\Support\Facades\Hash;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/buat-akun', function () {
    Login::create([
        'id_login' => 'admin',
        'password' => Hash::make('123'),
        'role' => 'admin'
    ]);

    Login::create([
        'id_login' => 'guru',
        'password' => Hash::make('123'),
        'role' => 'guru'
    ]);

    Login::create([
        'id_login' => 'siswa',
        'password' => Hash::make('123'),
        'role' => 'siswa'
    ]);

    return 'Akun test berhasil dibuat!';
});

Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin/user/create', [UserController::class, 'create']);
    Route::post('/admin/user/store', [UserController::class, 'store']);
});
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin
Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin/dashboard', fn() => view('admin.dashboard'));
});

// Guru
Route::middleware(['role:guru'])->group(function () {
    Route::get('/guru/dashboard', fn() => view('guru.dashboard'));
});

// Siswa
Route::middleware(['role:siswa'])->group(function () {
    Route::get('/siswa/dashboard', fn() => view('siswa.dashboard'));
});
