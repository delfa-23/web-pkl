<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Login;
use App\Models\TempatPkl;
use App\Models\Siswa;
use Illuminate\Http\Request;

class TempatPklController extends Controller
{
    public function index()
    {
        $login_id = session('login_id');
        $siswa = Siswa::where('login_id', $login_id)->firstOrFail();

        // Ambil semua tempat PKL yang diikuti siswa login + siswanya
        $tempat = $siswa->tempats()->with('siswas')->get();

        // ambil semua siswa buat dropdown anggota
        $siswas = Siswa::orderBy('nama')->get();

        return view('siswa.tempat.index', compact('tempat', 'siswas'));
    }


    public function create()
    {
        $login_id = session('login_id');
        $siswaLogin = Siswa::where('login_id', $login_id)->firstOrFail();

        // ambil siswa lain yg BELUM punya tempat PKL
        $siswas = Siswa::where('id', '!=', $siswaLogin->id)
            ->whereDoesntHave('tempats') // filter: hanya yang belum punya tempat
            ->orderBy('nama')
            ->get();

        return view('siswa.tempat.create', compact('siswaLogin', 'siswas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat_perusahaan' => 'required|string',
            'telepon_perusahaan' => 'nullable|string|max:20',
            'instruktur_perusahaan' => 'nullable|string|max:255',
            'anggota.*' => 'exists:siswas,id',
        ]);

        $login_id = session('login_id');
        $siswa = Siswa::where('login_id', $login_id)->firstOrFail();

        // gabungkan anggota tambahan + siswa pembuat
        $anggota = array_unique(array_merge([$siswa->id], $request->anggota ?? []));

        // cek apakah ada siswa yg sudah punya tempat PKL
        $sudahPunya = Siswa::whereIn('id', $anggota)
            ->whereHas('tempats')
            ->pluck('nama');

        if ($sudahPunya->isNotEmpty()) {
            return back()->with('error', 'Siswa berikut sudah punya tempat PKL: ' . $sudahPunya->join(', '));
        }

        // buat tempat PKL
        $tempat = TempatPkl::create([
            'nama_perusahaan' => $request->nama_perusahaan,
            'alamat_perusahaan' => $request->alamat_perusahaan,
            'telepon_perusahaan' => $request->telepon_perusahaan,
            'instruktur_perusahaan' => $request->instruktur_perusahaan,
            'status' => 'belum_terverifikasi',
        ]);

        // simpan ke pivot
        $tempat->siswas()->attach($anggota);

        return redirect()->route('siswa.tempat.index')
            ->with('success', 'Tempat PKL berhasil ditambahkan!');
    }

    // siswa edit
    public function edit($id)
    {
        $tempat = TempatPkl::with('siswas')->findOrFail($id);

        $siswas = Siswa::whereDoesntHave('tempats')
            ->orWhereHas('tempats', function ($q) use ($tempat) {
                $q->where('tempat_pkl_id', $tempat->id);
            })
            ->orderBy('nama')
            ->get();

        $gurus = Guru::orderBy('nama')->get(); // <--- tambahin ini biar admin kebaca
        $loginId = session('login_id') ?? (auth()->check() ? auth()->id() : null);
        $siswaLogin = $loginId ? Siswa::where('login_id', $loginId)->first() : null;

        return view('siswa.tempat.edit', compact('tempat', 'siswas', 'siswaLogin', 'gurus'));
    }

    public function update(Request $request, $id)
    {
        $tempat = TempatPkl::findOrFail($id);

        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat_perusahaan' => 'required|string',
            'telepon_perusahaan' => 'nullable|string|max:20',
            'instruktur_perusahaan' => 'nullable|string|max:255',
            'status' => 'nullable|in:belum_terverifikasi,proses,diterima,ditolak',
            'anggota.*' => 'nullable|exists:siswas,id',
        ]);

        $tempat->update([
            'nama_perusahaan' => $request->nama_perusahaan,
            'alamat_perusahaan' => $request->alamat_perusahaan,
            'telepon_perusahaan' => $request->telepon_perusahaan,
            'instruktur_perusahaan' => $request->instruktur_perusahaan,
        ]);

        $loginId = session('login_id') ?? (auth()->check() ? auth()->id() : null);
        $siswaLogin = $loginId ? Siswa::where('login_id', $loginId)->first() : null;

        // Ambil anggota dari request
        $anggota = array_filter($request->anggota ?? [], fn($v) => $v !== null && $v !== '');

        // pastikan siswa login selalu ikut
        if ($siswaLogin && !in_array($siswaLogin->id, $anggota)) {
            $anggota[] = $siswaLogin->id;
        }

        // cek kalau ada siswa yg udah punya tempat PKL lain (selain tempat ini)
        $sudahPunya = Siswa::whereIn('id', $anggota)
            ->whereHas('tempats', function ($q) use ($tempat) {
                $q->where('tempat_pkl_id', '!=', $tempat->id);
            })
            ->pluck('nama');

        if ($sudahPunya->isNotEmpty()) {
            return back()->with('error', 'Siswa berikut sudah terdaftar di tempat PKL lain: ' . $sudahPunya->join(', '));
        }

        // sync anggota
        $tempat->siswas()->sync(array_values(array_unique($anggota)));

        return redirect(
            session('role') === 'admin'
                ? route('admin.tempat.index')
                : route('siswa.tempat.index')
        )->with('success', 'Data tempat PKL berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $tempat = TempatPkl::findOrFail($id);
        $tempat->delete();

        return redirect()->route('siswa.tempat.index')->with('success', 'Tempat PKL berhasil dihapus.');
    }

    public function responUndangan($id, $status)
    {
        $siswaId = auth()->user()->siswa->id;

        $tempat = TempatPkl::findOrFail($id);
        $tempat->siswas()->updateExistingPivot($siswaId, [
            'status' => $status
        ]);

        return redirect()->route('siswa.tempat.index')->with('success', 'Respon undangan berhasil.');
    }

    public function adminIndex()
    {
        $tempats = TempatPkl::with(['siswa', 'siswas'])->get();
        $siswas  = Siswa::orderBy('nama')->get();

        return view('admin.tempat.index', compact('tempats', 'siswas'));
    }

    // Untuk admin
    // admin edit
    public function adminEdit($id)
    {
        $tempat = TempatPkl::with('siswas')->findOrFail($id);
        $siswas = Siswa::orderBy('nama')->get();
        $gurus  = Guru::orderBy('nama')->get();

        $userLoginId = session('login_id');
        $user = Login::where('id_login', $userLoginId)->first();

        return view('siswa.tempat.edit', compact('tempat', 'siswas', 'user', 'gurus'));
    }


    public function adminUpdate(Request $request, $id)
    {
        $tempat = TempatPkl::findOrFail($id);

        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat_perusahaan' => 'required|string',
            'telepon_perusahaan' => 'nullable|string|max:20',
            'pembimbing_perusahaan' => 'nullable|string|max:255', // atau 'instruktur_perusahaan' jika udah ganti
            'status' => 'required|in:belum_terverifikasi,proses,diterima,ditolak',
            'anggota.*' => 'nullable|exists:siswas,id',
            'jurusan.*' => 'nullable|string|max:255',
            'guru_id' => 'nullable|exists:gurus,id', // <-- validasi guru
        ]);

        // Update data utama (tambahkan guru_id)
        $tempat->update([
            'nama_perusahaan' => $request->nama_perusahaan,
            'alamat_perusahaan' => $request->alamat_perusahaan,
            'telepon_perusahaan' => $request->telepon_perusahaan,
            'pembimbing_perusahaan' => $request->pembimbing_perusahaan,
            'status' => $request->status,
            'guru_id' => $request->guru_id, // <-- simpan guru pembimbing
        ]);

        // Ambil data anggota + jurusan
        $anggotaIds = $request->input('anggota', []);
        $jurusans   = $request->input('jurusan', []);

        // Sync pivot (isi jurusan + status pivot)
        $syncData = [];
        foreach ($anggotaIds as $index => $siswaId) {
            if ($siswaId) {
                $syncData[$siswaId] = [
                    'jurusan' => $jurusans[$index] ?? null,
                    'status'  => $request->status, // isi status yang sama
                ];
            }
        }

        $tempat->siswas()->sync($syncData);

        return redirect()->route('admin.tempat.index')
            ->with('success', 'Data tempat PKL berhasil diperbarui!');
    }



    public function guruIndex()
    {
        // Guru hanya bisa lihat, tidak bisa edit
        $tempats = TempatPkl::with('siswas')->get();
        return view('guru.tempat.index', compact('tempats'));
    }

    public function guruShow($id)
    {
        $tempat = TempatPkl::with('siswas')->findOrFail($id);
        return view('guru.tempat.show', compact('tempat'));
    }
}
