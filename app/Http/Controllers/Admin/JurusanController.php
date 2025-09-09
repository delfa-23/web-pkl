<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusan = Jurusan::all();
        return view('admin.jurusan.index', compact('jurusan'));
    }

    public function create()
    {
        return view('admin.jurusan.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_jurusan'             => 'required|string|max:255',
        ]);

        // Simpan data jurusan
        Jurusan::create([
            'nama_jurusan' => $request->nama_jurusan,
        ]);

        return redirect()->route('admin.jurusan.index')->with('success', 'Data jurusan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        return view('admin.jurusan.edit', compact('jurusan'));

    }

    public function update(Request $request, $id)
    {
        $jurusan = Jurusan::findOrFail($id);

        // Validasi input
        $request->validate([
            'nama_jurusan'             => 'required|string|max:255',
        ]);


        // Update data jurusan
        $jurusan->update([
            'nama_jurusan' => $request->nama_jurusan,
        ]);

        return redirect()->route('admin.jurusan.index')->with('success', 'Data jurusan berhasil diperbarui');
    }



    public function destroy($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        $jurusan->delete();

        return redirect()->route('admin.jurusan.index')->with('success', 'Data jurusan berhasil dihapus');
    }

}
