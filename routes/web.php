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
use App\Http\Controllers\ExportSuratController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\SuratController;
use App\Models\Siswa;

/*
|--------------------------------------------------------------------------
| Akun Testing
|--------------------------------------------------------------------------
*/

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

    Route::prefix('admin/tempat')->middleware(['cekrole:admin'])->group(function () {
        Route::get('/', [TempatPKLController::class, 'adminIndex'])->name('admin.tempat.index');
        Route::get('/{id}/edit', [TempatPKLController::class, 'adminEdit'])->name('admin.tempat.edit');
        Route::put('/{id}/update', [TempatPKLController::class, 'adminUpdate'])->name('admin.tempat.update');
    });




    // CRUD Program Keahlian
    Route::prefix('admin/jurusan')->group(function () {
        Route::get('/', [JurusanController::class, 'index'])->name('admin.jurusan.index');
        Route::get('/create', [JurusanController::class, 'create'])->name('admin.jurusan.create');
        Route::post('/', [JurusanController::class, 'store'])->name('admin.jurusan.store');
        Route::get('/{id}/edit', [JurusanController::class, 'edit'])->name('admin.jurusan.edit');
        Route::put('/{id}', [JurusanController::class, 'update'])->name('admin.jurusan.update');
        Route::delete('/{id}', [JurusanController::class, 'destroy'])->name('admin.jurusan.destroy');
    });

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
        Route::get('/pengajuan', [SuratController::class, 'daftarSiswaPencarian'])->name('surat.daftar_siswa_pengajuan');
        Route::get('/pengajuan/{id}', [SuratController::class, 'showPencarian'])->name('surat.pengajuan');
        Route::get('/pengajuan/{id}/download', [SuratController::class, 'downloadPencarian'])->name('surat.download_pengajuan');

        // Surat Pemberangkatan
        Route::get('/pemberangkatan', [SuratController::class, 'daftarSiswaPemberangkatan'])->name('surat.daftar_siswa_pemberangkatan');
        Route::get('/pemberangkatan/{id}', [SuratController::class, 'showPemberangkatan'])->name('surat.pemberangkatan');
        Route::get('/pemberangkatan/{id}/download', [SuratController::class, 'downloadPemberangkatan'])->name('surat.download_pemberangkatan');

        // Surat Keterangan
        Route::get('/perjanjian', [SuratController::class, 'daftarSiswaKeterangan'])->name('surat.daftar_siswa_perjanjian');
        Route::get('/perjanjian/{id}', [SuratController::class, 'showKeterangan'])->name('surat.perjanjian');
        Route::get('/perjanjian/{id}/download', [SuratController::class, 'downloadKeterangan'])->name('surat.download_perjanjian');
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

    // Rute khusus Guru
    Route::prefix('guru')->middleware('role:guru')->group(function () {
        Route::get('/tempat', [TempatPklController::class, 'guruIndex'])->name('guru.tempat.index');
        Route::get('/tempat/{id}', [TempatPklController::class, 'guruShow'])->name('guru.tempat.show');
    });

    Route::get('/guru/activities', [\App\Http\Controllers\DailyActivityController::class, 'guruIndex'])
        ->name('guru.activity.index');

    // route yang sudah ada: lihat activity per siswa
    Route::get('/guru/siswa/{id}/activity', [\App\Http\Controllers\GuruController::class, 'showActivity'])
        ->name('guru.siswa.activity');
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
Route::prefix('siswa/tempat')->group(function () {
    Route::get('/', [TempatPKLController::class, 'index'])->name('siswa.tempat.index');
    Route::get('/create', [TempatPKLController::class, 'create'])->name('siswa.tempat.create');
    Route::post('/', [TempatPKLController::class, 'store'])->name('siswa.tempat.store');
    Route::get('/{id}/edit', [TempatPKLController::class, 'edit'])->name('siswa.tempat.edit');
    Route::put('/{id}', [TempatPKLController::class, 'update'])->name('siswa.tempat.update');
    Route::delete('/{id}', [TempatPKLController::class, 'destroy'])->name('siswa.tempat.destroy');
});

// Daily Activity
Route::prefix('siswa/activity')->group(function () {
    Route::get('/', [DailyActivityController::class, 'index'])->name('siswa.activity.index');
    Route::get('/create', [DailyActivityController::class, 'create'])->name('siswa.activity.create');
    Route::post('/store', [DailyActivityController::class, 'store'])->name('siswa.activity.store');
    Route::get('/{id}/edit', [DailyActivityController::class, 'edit'])->name('siswa.activity.edit');
    Route::put('/{id}/update', [DailyActivityController::class, 'update'])->name('siswa.activity.update');
    Route::delete('/{id}/destroy', [DailyActivityController::class, 'destroy'])->name('siswa.activity.destroy');
});


Route::get('/surat/izin/{id}/word', [SuratController::class, 'exportSuratIzinOrtu'])->name('surat.word_izin');
Route::get('/surat/export_pengajuan_pkl/{id}', [SuratController::class, 'exportSuratPengajuanPkl'])->name('surat.export_pengajuan_pkl');
Route::get('/surat/export_pemberangkatan/{id}', [SuratController::class, 'exportSuratPemberangkatan'])->name('surat.export_pemberangkatan');
Route::get('/surat/perjanjian/{id}/download', [SuratController::class, 'exportSuratPerjanjian'])->name('surat.download_perjanjian');

Route::get('/sertifikat/download/{id}', [SertifikatController::class, 'download'])->name('sertifikat.download');
