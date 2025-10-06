<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\TempatPkl;
use App\Models\DailyActivity;

class DashboardController extends Controller
{
    public function index()
    {
        // Untuk admin (jika butuh)
        $jumlahGuru = Guru::count();
        $jumlahSiswa = Siswa::count();

        // ambil login id (sesuai implementasimu)
        $loginId = session('login_id') ?? (auth()->check() ? auth()->id() : null);

        // cari record siswa yang terkait dengan login ini (jika ada)
        $siswa = $loginId ? Siswa::where('login_id', $loginId)->first() : null;

        // Hitung khusus untuk siswa yg login
        $jumlahTempat   = $siswa ? $siswa->tempats()->count() : 0;                // jumlah tempat PKL milik/gabung
        $jumlahActivity = DailyActivity::where('siswa_id', $siswa->id)->count();


        // Pilih view sesuai role (contoh)
        if (session('role') === 'admin') {
            // kembalikan view admin (sesuaikan nama variabel yg dibutuhkan admin)
            $jumlahPerusahaan = TempatPkl::count();
            return view('admin.dashboard', compact('jumlahGuru','jumlahSiswa','jumlahPerusahaan'));
        }

        // siswa dashboard
        return view('siswa.dashboard', compact('jumlahTempat','jumlahActivity', 'siswa'));
    }
}
