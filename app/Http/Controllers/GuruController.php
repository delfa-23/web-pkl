<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Login;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Siswa;

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
    public function dashboard(Request $request)
    {
        // Ambil guru berdasarkan login_id dari session
        $login_id = session('login_id');
        $guru = Guru::with('login')
            ->where('login_id', session('login_id'))  // pakai id integer
            ->first();

        if (!$guru) {
            return redirect('/')->with('error', 'Guru tidak ditemukan.');
        }

        // Ambil semua siswa beserta relasinya
        $query = Siswa::with(['login', 'tempatPKL', 'activities']);

        if ($request->has('jurusan') && $request->jurusan != '') {
            $query->where('jurusan', $request->jurusan);
        }
        if ($request->has('nama') && $request->nama != '') {
            $query->where('nama', 'like', '%' . $request->nama . '%');
        }

        $semuaSiswa = $query->get();

        return view('guru.dashboard', compact('guru', 'semuaSiswa'));
    }
    public function showTempat($id) {
        $siswa = Siswa::with('tempatPKL')->findOrFail($id);
        return view('guru.siswa.tempat', compact('siswa'));
    }

    public function showActivity($id) {
        $siswa = Siswa::with('activities')->findOrFail($id);
        return view('guru.siswa.activity', compact('siswa'));
    }


}
