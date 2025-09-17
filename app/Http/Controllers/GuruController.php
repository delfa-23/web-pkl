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

        $query = Siswa::with(['login', 'tempatPKL', 'activities']);

        if ($request->filled('jurusan')) {
            $query->where('jurusan', $request->jurusan);
        }
        if ($request->filled('nama')) {
            $query->where('nama', 'like', '%' . $request->nama . '%');
        }

        $semuaSiswa = Siswa::with(['login', 'tempats', 'activities'])->get();

        return view('guru.dashboard', compact('guru', 'semuaSiswa'));
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
