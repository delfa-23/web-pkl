<?php

namespace App\Http\Controllers;

use App\Models\TempatPkl;
use App\Models\Siswa;
use Illuminate\Http\Request;

class TempatPklController extends Controller
{
    public function index()
    {
        $login_id = session('login_id');
        $siswa = Siswa::where('login_id', $login_id)->firstOrFail();
        $tempat = TempatPkl::where('siswa_id', $siswa->id)->get();

        return view('siswa.tempat.index', compact('tempat'));
    }

    public function create()
    {
        return view('siswa.tempat.create');
    }

    public function store(Request $request)
    {
        $login_id = session('login_id');
        $siswa = Siswa::where('login_id', $login_id)->firstOrFail();

        $request->validate([
            'nama_perusahaan' => 'required|string',
            'alamat_perusahaan' => 'required|string',
            'telepon_perusahaan' => 'nullable|string',
            'pembimbing_perusahaan' => 'nullable|string',
        ]);

        TempatPkl::create([
            'siswa_id' => $siswa->id,
            'nama_perusahaan' => $request->nama_perusahaan,
            'alamat_perusahaan' => $request->alamat_perusahaan,
            'telepon_perusahaan' => $request->telepon_perusahaan,
            'pembimbing_perusahaan' => $request->pembimbing_perusahaan,
            'status' => 'Menunggu Verifikasi',
        ]);

        return redirect()->route('siswa.tempat.index')->with('success', 'Data tempat PKL berhasil ditambahkan');
    }

    public function edit($id)
    {
        $tempat = TempatPkl::findOrFail($id);
        return view('siswa.tempat.edit', compact('tempat'));
    }

    public function update(Request $request, $id)
    {
        $tempat = TempatPkl::findOrFail($id);

        $request->validate([
            'nama_perusahaan' => 'required|string',
            'alamat_perusahaan' => 'required|string',
            'telepon_perusahaan' => 'nullable|string',
            'pembimbing_perusahaan' => 'nullable|string',
        ]);

        $tempat->update([
            'nama_perusahaan' => $request->nama_perusahaan,
            'alamat_perusahaan' => $request->alamat_perusahaan,
            'telepon_perusahaan' => $request->telepon_perusahaan,
            'pembimbing_perusahaan' => $request->pembimbing_perusahaan,
            'status' => 'Menunggu Verifikasi',
        ]);

        return redirect()->route('siswa.tempat.index')->with('success', 'Data tempat PKL berhasil diperbarui');
    }
}
