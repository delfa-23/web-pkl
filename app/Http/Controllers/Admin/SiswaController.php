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
        // Validasi input
        $request->validate([
            'nama'             => 'required|string|max:255',
            'id_login'         => 'required|string|unique:logins,id_login',
            'password'         => 'required|string|min:3',
            'kelas'            => 'required|string',
            'jurusan'          => 'required|string',
            'nis'              => 'nullable|numeric',
            'nisn'             => 'nullable|string',
            'telepon'          => 'required|string',
            'nama_orangtua'    => 'nullable|string',
            'telepon_orangtua' => 'nullable|string',
            'alamat'           => 'nullable|string',
            'tempat_lahir'     => 'nullable|string',
            'tanggal_lahir'    => 'nullable|date',
        ]);

        // Buat login baru
        $login = Login::create([
            'id_login' => $request->id_login,
            'password' => Hash::make($request->password),
            'role'     => 'siswa',
        ]);

        // Buat siswa baru
        Siswa::create([
            'login_id'         => $login->id,
            'nama'             => $request->nama,
            'nis'              => $request->nis,
            'nisn'             => $request->nisn,
            'telepon'          => $request->telepon,
            'kelas'            => $request->kelas,
            'jurusan'          => $request->jurusan,
            'status'           => 'Aktif',
            'kehadiran'        => 0,
            'nama_orangtua'    => $request->nama_orangtua,
            'telepon_orangtua' => $request->telepon_orangtua,
            'alamat'           => $request->alamat,
            'tempat_lahir'     => $request->tempat_lahir,
            'tanggal_lahir'    => $request->tanggal_lahir,
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
        $siswa = Siswa::with('login')->findOrFail($id);

        // Validasi input
        $request->validate([
            'nama'             => 'required|string|max:255',
            'id_login'         => 'required|string|unique:logins,id_login,' . $siswa->login->id . ',id',
            'password'         => 'nullable|string|min:3', // password bisa diubah, boleh kosong
            'kelas'            => 'required|string',
            'jurusan'          => 'required|string',
            'nis'              => 'nullable|numeric',
            'nisn'             => 'nullable|string',
            'telepon'          => 'required|string',
            'nama_orangtua'    => 'nullable|string',
            'telepon_orangtua' => 'nullable|string',
            'alamat'           => 'nullable|string',
            'tempat_lahir'     => 'nullable|string',
            'tanggal_lahir'    => 'nullable|date',
            'status'           => 'required|in:Aktif,Nonaktif',
        ]);

        // Update login
        $siswa->login->update([
            'id_login' => $request->id_login,
            'password' => $request->password ? Hash::make($request->password) : $siswa->login->password,
        ]);

        // Update data siswa
        $siswa->update([
            'nama'             => $request->nama,
            'nis'              => $request->nis,
            'nisn'             => $request->nisn,
            'telepon'          => $request->telepon,
            'kelas'            => $request->kelas,
            'jurusan'          => $request->jurusan,
            'status'           => $request->status,
            'nama_orangtua'    => $request->nama_orangtua,
            'telepon_orangtua' => $request->telepon_orangtua,
            'alamat'           => $request->alamat,
            'tempat_lahir'     => $request->tempat_lahir,
            'tanggal_lahir'    => $request->tanggal_lahir,
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
