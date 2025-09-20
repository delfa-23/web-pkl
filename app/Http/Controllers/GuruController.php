<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Guru;

class GuruController extends Controller
{
    public function dashboard(Request $request)
    {
        $loginId = session('login_id');

        $guru = Guru::with('login')
            ->where('login_id', $loginId)
            ->first();

        if (!$guru) {
            return redirect('/')->with('error', 'Guru tidak ditemukan.');
        }

        $query = Siswa::query();

    if ($request->filled('nama')) {
        $query->where('nama', 'like', '%' . $request->nama . '%');
    }

    if ($request->filled('jurusan')) {
        $query->where('jurusan', $request->jurusan);
    }

    $semuaSiswa = $query->get();
    $jumlahTempat = $semuaSiswa->count();

    return view('guru.dashboard', compact('semuaSiswa', 'jumlahTempat', 'guru'));


    }

    public function showTempat($id)
    {
        $siswa = Siswa::with('tempats')->findOrFail($id);

        return view('guru.siswa.tempat', compact('siswa'));
    }

    public function showActivity($id)
    {
        $siswa = Siswa::with('activities')->findOrFail($id);
        return view('guru.siswa.activity', compact('siswa'));
    }
}
