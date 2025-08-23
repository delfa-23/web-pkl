<?php

namespace App\Http\Controllers;

use App\Models\TempatPkl;
use Illuminate\Http\Request;

class TempatPklController extends Controller
{
    public function index()
    {
        $login_id = session('login_id');
        $tempat = TempatPkl::where('login_id', $login_id)->get();
        return view('siswa.tempat.index', compact('tempat'));
    }

    public function create()
    {
        return view('siswa.tempat.create');
    }

    public function store(Request $request)
    {
        $login_id = session('login_id');

        $request->validate([
            'nama_siswa' => 'required',
            'kelas' => 'required',
            'program_keahlian' => 'required',
            'tempat_pkl' => 'required',
        ]);

        TempatPkl::create([
            'login_id' => $login_id,
            'nama_siswa' => $request->nama_siswa,
            'kelas' => $request->kelas,
            'program_keahlian' => $request->program_keahlian,
            'tempat_pkl' => $request->tempat_pkl,
            'status' => 'Menunggu Verifikasi'
        ]);

        return redirect()->route('siswa.tempat.index');
    }
    public function edit($id)
    {
        $tempat = TempatPKL::findOrFail($id);
        return view('siswa.tempat.edit', compact('tempat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'no' => 'nullable|string',
            'nama_siswa' => 'required|string',
            'kelas' => 'required|string',
            'program_keahlian' => 'required|string',
            'tempat_pkl' => 'required|string',
            'status' => 'nullable|in:Menunggu Verifikasi,Aktif,Nonaktif',
        ]);

        $tempat = TempatPKL::findOrFail($id);

        $tempat->update([
            'no' => $request->no,
            'nama_siswa' => $request->nama_siswa,
            'kelas' => $request->kelas,
            'program_keahlian' => $request->program_keahlian,
            'tempat_pkl' => $request->tempat_pkl,
            'status' => 'Menunggu Verifikasi'
        ]);

        return redirect()->route('siswa.tempat.index')->with('success', 'Data berhasil diperbarui');
    }

}

