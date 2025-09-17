<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyActivity;
use Illuminate\Support\Facades\Storage;

class DailyActivityController extends Controller
{
    // Tampilkan semua activity siswa
    public function index()
    {
        $activities = DailyActivity::where('login_id', session('login_id'))->get();
        return view('siswa.activity.index', compact('activities'));
    }

    // Form tambah activity
    public function create()
    {
        return view('siswa.activity.create');
    }

    // Simpan activity baru
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kegiatan' => 'required|string',
            'foto'     => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'tanggal.required' => 'Tanggal & waktu wajib diisi.',
            'tanggal.date'     => 'Format tanggal tidak valid.',
            'kegiatan.required' => 'Kegiatan wajib diisi.',
            'foto.required'    => 'Foto wajib diupload.',
            'foto.image'       => 'File harus berupa gambar.',
            'foto.mimes'       => 'Format foto hanya boleh JPG, JPEG, atau PNG.',
            'foto.max'         => 'Ukuran foto maksimal 2MB.',
        ]);

        try {
            $fotoPath = $request->file('foto')->store('daily_activities', 'public');

            DailyActivity::create([
                'login_id' => session('login_id'),
                'tanggal'  => $request->tanggal,
                'kegiatan' => $request->kegiatan,
                'foto'     => $fotoPath,
            ]);

            return redirect()->route('siswa.activity.index')
                ->with('success', 'Aktivitas berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan foto: ' . $e->getMessage());
        }
    }

    // Form edit activity
    public function edit($id)
    {
        $activity = DailyActivity::findOrFail($id);
        return view('siswa.activity.edit', compact('activity'));
    }

    // Update activity
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal'  => 'required|date',
            'kegiatan' => 'required|string',
            'foto'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'tanggal.required' => 'Tanggal & waktu wajib diisi.',
            'tanggal.date'     => 'Format tanggal tidak valid.',
            'kegiatan.required' => 'Kegiatan wajib diisi.',
            'foto.image'       => 'File harus berupa gambar.',
            'foto.mimes'       => 'Format foto hanya boleh JPG, JPEG, atau PNG.',
            'foto.max'         => 'Ukuran foto maksimal 2MB.',
        ]);

        $activity = DailyActivity::findOrFail($id);

        try {
            $data = [
                'tanggal'  => $request->tanggal,
                'kegiatan' => $request->kegiatan,
            ];

            if ($request->hasFile('foto')) {
                if ($activity->foto && Storage::disk('public')->exists($activity->foto)) {
                    Storage::disk('public')->delete($activity->foto);
                }

                $fotoPath = $request->file('foto')->store('daily_activities', 'public');
                $data['foto'] = $fotoPath;
            }

            $activity->update($data);

            return redirect()->route('siswa.activity.index')
                ->with('success', 'Aktivitas berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan foto: ' . $e->getMessage());
        }
    }


    // Hapus activity
    public function destroy($id)
    {
        $activity = DailyActivity::findOrFail($id);

        if ($activity->foto && Storage::disk('public')->exists($activity->foto)) {
            Storage::disk('public')->delete($activity->foto);
        }

        $activity->delete();

        return redirect()->route('siswa.activity.index')
            ->with('success', 'Aktivitas berhasil dihapus');
    }

    public function guruIndex()
    {
        // Ambil semua daily activity + relasi siswa
        $activities = DailyActivity::with('siswa')->latest()->get();

        return view('guru.activity.index', compact('activities'));
    }
}
