<?php

namespace App\Http\Controllers;

use App\Models\Login;
use App\Models\TempatPkl;

class AdminController extends Controller
{
    public function index()
    {
        // Hitung jumlah guru dan siswa
        $jumlahGuru = Login::where('role', 'guru')->count();
        $jumlahSiswa = Login::where('role', 'siswa')->count();

        // Hitung jumlah perusahaan (tempat PKL)
        $jumlahPerusahaan = TempatPkl::count();

        return view('admin.dashboard', compact('jumlahGuru', 'jumlahSiswa', 'jumlahPerusahaan'));
    }

}

