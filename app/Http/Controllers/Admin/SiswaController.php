<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::with('login')->get();
        return view('admin.siswa.index', compact('siswas'));
    }

    public function create()
    {
        return view('admin.siswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'id_login' => 'required|unique:logins',
            'password' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
        ]);

        $login = Login::create([
            'id_login' => $request->id_login,
            'password' => Hash::make($request->password),
            'role' => 'siswa',
        ]);

        Siswa::create([
            'login_id' => $login->id,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
        ]);

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil ditambahkan');
    }

    public function edit($id)
    {
        $siswa = Siswa::with('login')->findOrFail($id);
        return view('admin.siswa.edit', compact('siswa'));
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'id_login' => 'required|unique:logins,id_login,' . $siswa->login_id,
            'kelas' => 'required',
            'jurusan' => 'required',
        ]);

        $siswa->login->update([
            'id_login' => $request->id_login,
            'password' => $request->password ? Hash::make($request->password) : $siswa->login->password,
        ]);

        $siswa->update([
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
        ]);

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil diperbarui');
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->login->delete(); // hapus akun login juga
        $siswa->delete();

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil dihapus');
    }

    public function dashboard()
    {
        $loginId = session('login_id'); // pastikan ini id numerik dari logins.id

        $siswa = Siswa::where('login_id', $loginId)->first();

        if (!$siswa) {
            abort(404, 'Data siswa tidak ditemukan');
        }

        return view('siswa.dashboard', compact('siswa'));
    }
}
