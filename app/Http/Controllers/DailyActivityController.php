<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyActivity;

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
        ]);

        DailyActivity::create([
            'login_id' => session('login_id'),
            'tanggal' => $request->tanggal,
            'kegiatan' => $request->kegiatan,
        ]);

        return redirect()->route('siswa.activity.index')->with('success', 'Aktivitas berhasil ditambahkan');
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
            'tanggal' => 'required|date',
            'kegiatan' => 'required|string',
        ]);

        $activity = DailyActivity::findOrFail($id);
        $activity->update([
            'tanggal' => $request->tanggal,
            'kegiatan' => $request->kegiatan,
        ]);

        return redirect()->route('siswa.activity.index')->with('success', 'Aktivitas berhasil diupdate');
    }

    // Hapus activity
    public function destroy($id)
    {
        $activity = DailyActivity::findOrFail($id);
        $activity->delete();
        return redirect()->route('siswa.activity.index')->with('success', 'Aktivitas berhasil dihapus');
    }
}
