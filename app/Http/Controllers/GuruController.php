<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Login;
use Illuminate\Http\Request;
use App\Models\User;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guru = Guru::with('login')
            ->whereHas('login', function($query) {
                $query->where('role', 'guru');
            })
            ->get();

        return view('admin.guru.index', compact('guru'));
    }

    public function create()
    {
        return view('admin.guru.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_login' => 'required|string',
            'password' => 'nullable|string', // nullable biar kalau udah ada nggak wajib isi
            'nama' => 'required|string',
            'mapel' => 'required|string'
        ]);

        // Cek apakah id_login sudah ada di logins
        $login = Login::where('id_login', $request->id_login)->first();

        if (!$login) {
            // Kalau belum ada, buat akun login baru
            $login = Login::create([
                'id_login' => $request->id_login,
                'password' => bcrypt($request->password ?? '123'), // default password
                'role' => 'guru'
            ]);
        }

        // Cek apakah guru untuk login_id ini sudah ada
        $guruExists = Guru::where('login_id', $login->id)->exists();

        if ($guruExists) {
            return redirect()->back()->with('error', 'Guru ini sudah terdaftar.');
        }

        // Simpan guru
        Guru::create([
            'login_id' => $login->id,
            'nama' => $request->nama,
            'mapel' => $request->mapel
        ]);

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil ditambahkan');
    }


    public function edit(Guru $guru)
    {
        return view('admin.guru.edit', compact('guru'));
    }

    public function update(Request $request, Guru $guru)
{
    $request->validate([
        'nama' => 'required',
        'id_login' => 'required',
        'mapel' => 'required'
    ]);

    // Update tabel logins
    $guru->login->update([
        'id_login' => $request->id_login,
        // kalau password diisi baru update
        'password' => $request->password ? bcrypt($request->password) : $guru->login->password
    ]);

    // Update tabel gurus
    $guru->update([
        'nama' => $request->nama,
        'mapel' => $request->mapel
    ]);

    return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil diupdate.');
}


    public function destroy(Guru $guru)
    {
        // hapus login yang terkait
        $guru->login()->delete();

        // hapus guru
        $guru->delete();

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil dihapus.');
    }

    public function dashboard()
    {
        $loginId = session('login_id');  // ini harus id integer dari logins.id

        $guru = Guru::where('login_id', $loginId)->first();

        if (!$guru) {
            abort(404, 'Data guru tidak ditemukan');
        }

        return view('guru.dashboard', compact('guru'));
    }

}
