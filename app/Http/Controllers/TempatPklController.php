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
        // Ambil login_id dari session
        $login_id = session('login_id');

        // Ambil data siswa yang login
        $siswaLogin = Siswa::where('login_id', $login_id)->firstOrFail();

        // Ambil daftar siswa lain untuk dropdown anggota
        $siswas = Siswa::where('id', '!=', $siswaLogin->id)->get();

        // Kirim ke view
        return view('siswa.tempat.create', compact('siswaLogin', 'siswas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required',
            'alamat_perusahaan' => 'required',
            'anggota.*' => 'exists:siswas,id', // validasi anggota
        ]);

        $login_id = session('login_id');
        $siswa = Siswa::where('login_id', $login_id)->firstOrFail();

        $tempat = TempatPKL::create([
            'siswa_id' => $siswa->id,
            'nama_perusahaan' => $request->nama_perusahaan,
            'alamat_perusahaan' => $request->alamat_perusahaan,
            'telepon_perusahaan' => $request->telepon_perusahaan,
            'pembimbing_perusahaan' => $request->pembimbing_perusahaan,
            'status' => 'belum_terverifikasi',
        ]);

        // pastikan array unik
        $anggota = array_unique($request->anggota);
        $tempat->siswas()->attach($anggota);

        return redirect()->route('siswa.dashboard')->with('success', 'Tempat PKL berhasil ditambahkan!');
    }



    public function edit($id)
    {
        $tempat = TempatPkl::findOrFail($id);

        $login_id = session('login_id');
        $siswaLogin = Siswa::where('login_id', $login_id)->first();

        if(!$siswaLogin){
            return redirect()->back()->with('error', 'Data siswa login tidak ditemukan.');
        }

        $siswas = Siswa::where('id', '!=', $siswaLogin->id)->get();

        return view('siswa.tempat.edit', compact('tempat', 'siswas', 'siswaLogin'));
    }


    public function update(Request $request, $id)
    {
        $tempat = TempatPkl::findOrFail($id);

        $request->validate([
            'nama_perusahaan' => 'required|string',
            'alamat_perusahaan' => 'required|string',
            'telepon_perusahaan' => 'nullable|string',
            'pembimbing_perusahaan' => 'nullable|string',
            'status' => 'nullable|in:belum_terverifikasi,proses,diterima,ditolak',
            'anggota.*' => 'exists:siswas,id',
        ]);

        $data = [
            'nama_perusahaan' => $request->nama_perusahaan,
            'alamat_perusahaan' => $request->alamat_perusahaan,
            'telepon_perusahaan' => $request->telepon_perusahaan,
            'pembimbing_perusahaan' => $request->pembimbing_perusahaan,
        ];

        if (session('role') === 'admin' && $request->filled('status')) {
            $data['status'] = $request->status;
        }

        $tempat->update($data);

        // update pivot anggota
        $tempat->siswas()->sync($request->anggota ?? []);

        return redirect(
            session('role') === 'admin'
                ? route('admin.tempat.index')
                : route('siswa.tempat.index')
        )->with('success', 'Data tempat PKL berhasil diperbarui');
    }



    public function adminIndex()
    {
        $tempats = TempatPKL::with('siswa')->get();
        return view('admin.tempat.index', compact('tempats'));
    }

    public function adminEdit($id)
    {
        $tempat = TempatPKL::with('siswa')->findOrFail($id);
        return view('admin.tempat.edit', compact('tempat'));
    }

    public function adminUpdate(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:belum_terverifikasi,proses,diterima,ditolak',
        ]);

        $tempat = TempatPkl::findOrFail($id);
        $tempat->update([
            'status' => $request->status
        ]);

        return redirect()->route('admin.tempat.index')->with('success', 'Status berhasil diperbarui!');
    }


}
