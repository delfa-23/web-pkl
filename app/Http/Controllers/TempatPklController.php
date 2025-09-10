<?php

namespace App\Http\Controllers;

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

        // load tempat + relasi siswas
        $tempat = TempatPkl::with('siswas')
                    ->where('siswa_id', $siswa->id)
                    ->get();

        // ambil semua siswa buat dropdown anggota
        $siswas = Siswa::orderBy('nama')->get();

        return view('siswa.tempat.index', compact('tempat', 'siswas'));
    }

    public function create()
    {
        $login_id = session('login_id');
        $siswaLogin = Siswa::where('login_id', $login_id)->firstOrFail();

        $siswas = Siswa::where('id', '!=', $siswaLogin->id)->get();

        return view('siswa.tempat.create', compact('siswaLogin', 'siswas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required',
            'alamat_perusahaan' => 'required',
            'anggota.*' => 'exists:siswas,id',
        ]);

        $login_id = session('login_id');
        $siswa = Siswa::where('login_id', $login_id)->firstOrFail();

        $tempat = TempatPkl::create([
            'siswa_id' => $siswa->id,
            'nama_perusahaan' => $request->nama_perusahaan,
            'alamat_perusahaan' => $request->alamat_perusahaan,
            'telepon_perusahaan' => $request->telepon_perusahaan,
            'pembimbing_perusahaan' => $request->pembimbing_perusahaan,
            'status' => 'belum_terverifikasi',
        ]);

        $anggota = array_unique($request->anggota ?? []);
        $tempat->siswas()->attach($anggota);

        return redirect()->route('siswa.tempat.index')
            ->with('success', 'Tempat PKL berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $tempat = TempatPkl::with('siswas')->findOrFail($id);

        // Ambil semua siswa yang bisa dipilih (urut nama)
        $siswas = Siswa::orderBy('nama')->get();

        // Ambil siswa yang login (sesuaikan penggunaan session/auth di aplikasi kamu)
        $loginId = session('login_id') ?? (auth()->check() ? auth()->id() : null);
        $siswaLogin = $loginId ? Siswa::where('login_id', $loginId)->first() : null;

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
            'anggota.*' => 'nullable|exists:siswas,id',
        ]);

        $tempat->update([
            'nama_perusahaan' => $request->nama_perusahaan,
            'alamat_perusahaan' => $request->alamat_perusahaan,
            'telepon_perusahaan' => $request->telepon_perusahaan,
            'pembimbing_perusahaan' => $request->pembimbing_perusahaan,
        ]);

        // Pastikan ambil siswa login dengan cara yang aman
        $loginId = session('login_id') ?? (auth()->check() ? auth()->id() : null);
        $siswaLogin = $loginId ? Siswa::where('login_id', $loginId)->first() : null;

        // Ambil anggota dari request (buang empty string)
        $anggota = array_filter($request->anggota ?? [], function($v) { return $v !== null && $v !== ''; });

        // Force siswa login selalu ada di anggota (aman jika user mengutak-atik form)
        if ($siswaLogin) {
            if (!in_array($siswaLogin->id, $anggota)) {
                $anggota[] = $siswaLogin->id;
            }
        }

        $tempat->siswas()->sync(array_values(array_unique($anggota)));

        return redirect(
            session('role') === 'admin'
                ? route('admin.tempat.index')
                : route('siswa.tempat.index')
        )->with('success', 'Data tempat PKL berhasil diperbarui');
    }



     public function adminIndex()
    {
        $tempats = TempatPkl::with(['siswa', 'siswas'])->get();
        $siswas  = Siswa::orderBy('nama')->get();

        return view('admin.tempat.index', compact('tempats', 'siswas'));
    }

    // Untuk admin
    public function adminEdit($id)
    {
        $tempat = TempatPKL::with('siswas')->findOrFail($id);
        $siswas = Siswa::all();

        $userLoginId = session('login_id'); // atau auth()->id() jika pakai auth
        $user = Login::where('id_login', $userLoginId)->first();

        return view('edit-tempat', compact('tempat', 'siswas', 'user'));
    }



    public function adminUpdate(Request $request, $id)
    {
        $tempat = TempatPkl::findOrFail($id);

        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat_perusahaan' => 'required|string',
            'telepon_perusahaan' => 'nullable|string|max:20',
            'pembimbing_perusahaan' => 'nullable|string|max:255',
            'status' => 'required|in:belum_terverifikasi,proses,diterima,ditolak',
            'anggota.*' => 'nullable|exists:siswas,id',
            'jurusan.*' => 'nullable|string|max:255',
        ]);

        // Update data utama
        $tempat->update([
            'nama_perusahaan' => $request->nama_perusahaan,
            'alamat_perusahaan' => $request->alamat_perusahaan,
            'telepon_perusahaan' => $request->telepon_perusahaan,
            'pembimbing_perusahaan' => $request->pembimbing_perusahaan,
            'status' => $request->status,
        ]);

        // Ambil data anggota + jurusan dari request
        $anggotaIds = $request->input('anggota', []);
        $jurusans   = $request->input('jurusan', []);

        // Siapkan array untuk sync pivot (siswa_id => ['jurusan' => ...])
        $syncData = [];
        foreach ($anggotaIds as $index => $siswaId) {
            if ($siswaId) {
                $syncData[$siswaId] = [
                    'jurusan' => $jurusans[$index] ?? null,
                ];
            }
        }

        // Sync pivot table
        $tempat->siswas()->sync($syncData);

        return redirect()->route('admin.tempat.index')
                 ->with('success', 'Data tempat PKL berhasil diperbarui!');
    }



}
