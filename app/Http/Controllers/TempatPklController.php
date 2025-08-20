<?php

namespace App\Http\Controllers;

use App\Models\TempatPkl;
use Illuminate\Http\Request;

class TempatPklController extends Controller
{
    public function index()
    {
        $login_id = session('login_id');
        $tempat = TempatPkl::where('login_id', $login_id)->first();
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
            'nama' => 'required',
            'jurusan' => 'required',
            'nama_perusahaan' => 'required',
            'tempat_pkl' => 'required',
        ]);

        TempatPkl::create([
            'login_id' => $login_id,
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
            'nama_perusahaan' => $request->nama_perusahaan,
            'tempat_pkl' => $request->tempat_pkl,
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
            'nama' => 'required|string',
            'jurusan' => 'required|string',
            'nama_perusahaan' => 'required|string',
            'tempat_pkl' => 'required|string',
        ]);

        $tempat = TempatPKL::findOrFail($id);
        $tempat->update($request->all());

        return redirect()->route('siswa.tempat.index')->with('success', 'Data tempat PKL berhasil diupdate.');
    }
}

