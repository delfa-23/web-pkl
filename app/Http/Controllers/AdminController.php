<?php

namespace App\Http\Controllers;

use App\Models\Login;

class AdminController extends Controller
{
    public function index()
    {
        // Hitung jumlah guru dan siswa dari tabel logins
        $jumlahGuru = Login::where('role', 'guru')->count();
        $jumlahSiswa = Login::where('role', 'siswa')->count();

        return view('admin.dashboard', compact('jumlahGuru', 'jumlahSiswa'));
    }
}

