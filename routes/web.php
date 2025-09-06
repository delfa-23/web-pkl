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
use App\Http\Controllers\Admin\GuruController as AdminGuruController;
use App\Http\Controllers\admin\JurusanController;
use App\Http\Controllers\SuratController;

/*
|--------------------------------------------------------------------------
| Akun Testing
|--------------------------------------------------------------------------
*/
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

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['cekrole:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // CRUD Guru
    Route::prefix('admin/guru')->group(function () {
        Route::get('/', [AdminGuruController::class, 'index'])->name('admin.guru.index');
        Route::get('/create', [AdminGuruController::class, 'create'])->name('admin.guru.create');
        Route::post('/', [AdminGuruController::class, 'store'])->name('admin.guru.store');
        Route::get('/{guru}/edit', [AdminGuruController::class, 'edit'])->name('admin.guru.edit');
        Route::put('/{guru}', [AdminGuruController::class, 'update'])->name('admin.guru.update');
        Route::delete('/{guru}', [AdminGuruController::class, 'destroy'])->name('admin.guru.destroy');
    });

    // CRUD Siswa
    Route::prefix('admin/siswa')->group(function () {
        Route::get('/', [SiswaController::class, 'index'])->name('admin.siswa.index');
        Route::get('/create', [SiswaController::class, 'create'])->name('admin.siswa.create');
        Route::post('/', [SiswaController::class, 'store'])->name('admin.siswa.store');
        Route::get('/{id}/edit', [SiswaController::class, 'edit'])->name('admin.siswa.edit');
        Route::put('/{id}', [SiswaController::class, 'update'])->name('admin.siswa.update');
        Route::delete('/{id}', [SiswaController::class, 'destroy'])->name('admin.siswa.destroy');
    });

<<<<<<< HEAD
    Route::prefix('admin/tempat')->middleware(['cekrole:admin'])->group(function () {
        Route::get('/', [TempatPKLController::class, 'adminIndex'])->name('admin.tempat.index');
        Route::get('/{id}/edit', [TempatPKLController::class, 'adminEdit'])->name('admin.tempat.edit');
        Route::put('/{id}/update', [TempatPKLController::class, 'update'])->name('admin.tempat.update');
    });



=======
    // CRUD Program Keahlian
    Route::prefix('admin/jurusan')->group(function () {
        Route::get('/', [JurusanController::class, 'index'])->name('admin.jurusan.index');
        Route::get('/create', [JurusanController::class, 'create'])->name('admin.jurusan.create');
        Route::post('/', [JurusanController::class, 'store'])->name('admin.jurusan.store');
        Route::get('/{id}/edit', [JurusanController::class, 'edit'])->name('admin.jurusan.edit');
        Route::put('/{id}', [JurusanController::class, 'update'])->name('admin.jurusan.update');
        Route::delete('/{id}', [JurusanController::class, 'destroy'])->name('admin.jurusan.destroy');
    });

>>>>>>> 38be53c (Crud Jurusan)
    /*
    |--------------------------------------------------------------------------
    | Surat Routes (khusus Admin)
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin/surat')->group(function () {
        Route::get('/siswa', [SuratController::class, 'daftarSiswa'])->name('surat.daftar_siswa');

        // Surat Izin Orang Tua
        Route::get('/izin', [SuratController::class, 'daftarSiswaIzin'])->name('surat.daftar_siswa_izin');
        Route::get('/izin/{id}', [SuratController::class, 'showIzin'])->name('surat.izin_orangtua');
        Route::get('/izin/{id}/download', [SuratController::class, 'downloadIzin'])->name('surat.download_izin');

        // Surat Pernyataan
        Route::get('/pernyataan', [SuratController::class, 'daftarSiswaPernyataan'])->name('surat.daftar_siswa_pernyataan');
        Route::get('/pernyataan/{id}', [SuratController::class, 'showPernyataan'])->name('surat.pernyataan');
        Route::get('/pernyataan/{id}/download', [SuratController::class, 'downloadPernyataan'])->name('surat.download_pernyataan');

        // Surat Pengantar
        Route::get('/pengantar', [SuratController::class, 'daftarSiswaPengantar'])->name('surat.daftar_siswa_pengantar');
        Route::get('/pengantar/{id}', [SuratController::class, 'showPengantar'])->name('surat.pengantar');
        Route::get('/pengantar/{id}/download', [SuratController::class, 'downloadPengantar'])->name('surat.download_pengantar');

        // Surat Pencarian
        Route::get('/pencarian', [SuratController::class, 'daftarSiswaPencarian'])->name('surat.daftar_siswa_pencarian');
        Route::get('/pencarian/{id}', [SuratController::class, 'showPencarian'])->name('surat.pencarian');
        Route::get('/pencarian/{id}/download', [SuratController::class, 'downloadPencarian'])->name('surat.download_pencarian');

        // Surat Pemberangkatan
        Route::get('/pemberangkatan', [SuratController::class, 'daftarSiswaPemberangkatan'])->name('surat.daftar_siswa_pemberangkatan');
        Route::get('/pemberangkatan/{id}', [SuratController::class, 'showPemberangkatan'])->name('surat.pemberangkatan');
        Route::get('/pemberangkatan/{id}/download', [SuratController::class, 'downloadPemberangkatan'])->name('surat.download_pemberangkatan');

        // Surat Keterangan
        Route::get('/keterangan', [SuratController::class, 'daftarSiswaKeterangan'])->name('surat.daftar_siswa_keterangan');
        Route::get('/keterangan/{id}', [SuratController::class, 'showKeterangan'])->name('surat.keterangan');
        Route::get('/keterangan/{id}/download', [SuratController::class, 'downloadKeterangan'])->name('surat.download_keterangan');

        // Surat Peminatan
        Route::get('/peminatan', [SuratController::class, 'daftarSiswaPeminatan'])->name('surat.daftar_siswa_peminatan');
        Route::get('/peminatan/{id}', [SuratController::class, 'showPeminatan'])->name('surat.peminatan');
        Route::get('/peminatan/{id}/download', [SuratController::class, 'downloadPeminatan'])->name('surat.download_peminatan');
    });
});

/*
|--------------------------------------------------------------------------
| Guru Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['cekrole:guru'])->group(function () {
    Route::get('/guru/dashboard', [GuruController::class, 'dashboard'])->name('guru.dashboard');
    Route::get('/guru/siswa/{id}', [GuruController::class, 'showSiswa'])->name('guru.siswa.show');
    Route::get('/guru/siswa/{id}/tempat', [GuruController::class, 'showTempat'])->name('guru.siswa.tempat');
    Route::get('/guru/siswa/{id}/activity', [GuruController::class, 'showActivity'])->name('guru.siswa.activity');
});

/*
|--------------------------------------------------------------------------
| Siswa Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['cekrole:siswa'])->group(function () {
    Route::get('/siswa/dashboard', [SiswaController::class, 'dashboard'])->name('siswa.dashboard');
});

// Tempat PKL
Route::prefix('siswa/tempat')->group(function() {
    Route::get('/', [TempatPKLController::class, 'index'])->name('siswa.tempat.index');
    Route::get('/create', [TempatPKLController::class, 'create'])->name('siswa.tempat.create');
    Route::post('/store', [TempatPKLController::class, 'store'])->name('siswa.tempat.store');
    Route::get('/{id}/edit', [TempatPKLController::class, 'edit'])->name('siswa.tempat.edit');
    Route::put('/{id}/update', [TempatPKLController::class, 'update'])->name('siswa.tempat.update');
});

// Daily Activity
Route::prefix('siswa/activity')->group(function() {
    Route::get('/', [DailyActivityController::class, 'index'])->name('siswa.activity.index');
    Route::get('/create', [DailyActivityController::class, 'create'])->name('siswa.activity.create');
    Route::post('/store', [DailyActivityController::class, 'store'])->name('siswa.activity.store');
    Route::get('/{id}/edit', [DailyActivityController::class,'edit'])->name('siswa.activity.edit');
    Route::put('/{id}/update', [DailyActivityController::class,'update'])->name('siswa.activity.update');
    Route::delete('/{id}/destroy', [DailyActivityController::class, 'destroy'])->name('siswa.activity.destroy');
});
