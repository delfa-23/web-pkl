<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;
use App\Models\DailyActivity;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class DailyActivityController extends Controller
{
    // Tampilkan semua activity siswa
    public function index()
    {
        $siswa = \App\Models\Siswa::with(['tempats.guru'])
            ->where('login_id', session('login_id'))
            ->first();

        $activities = \App\Models\DailyActivity::where('login_id', session('login_id'))->get();

        return view('siswa.activity.index', compact('siswa', 'activities'));
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
            'tanggal'       => 'required|date',
            'waktu_mulai'   => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
            'kegiatan'      => 'required|string',
            'deskripsi'     => 'nullable|string',
            'foto'          => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        try {
            $fotoPath = $request->file('foto')->store('daily_activities', 'public');

            // ===== AI RINGKASAN =====
            $ringkasanAI = null;
            if ($request->filled('deskripsi')) {
                $ringkasanAI = $this->generateRingkasan($request->deskripsi);
            }

            DailyActivity::create([
                'login_id'      => session('login_id'),
                'tanggal'       => $request->tanggal,
                'waktu_mulai'   => $request->waktu_mulai,
                'waktu_selesai' => $request->waktu_selesai,
                'kegiatan'      => $request->kegiatan,
                'deskripsi'     => $request->deskripsi,
                'ringkasan_ai'  => $ringkasanAI,
                'foto'          => $fotoPath,
            ]);

            return redirect()->route('siswa.activity.index')
                ->with('success', 'Aktivitas berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage());
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
            'tanggal'       => 'required|date',
            'waktu_mulai'   => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
            'kegiatan'      => 'required|string',
            'deskripsi'     => 'nullable|string',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $activity = DailyActivity::findOrFail($id);

        try {
            $data = [
                'tanggal'       => $request->tanggal,
                'waktu_mulai'   => $request->waktu_mulai,
                'waktu_selesai' => $request->waktu_selesai,
                'kegiatan'      => $request->kegiatan,
                'deskripsi'     => $request->deskripsi,
            ];

            // ===== AI RINGKASAN =====
            if ($request->filled('deskripsi') && $request->deskripsi !== $activity->deskripsi) {
                $data['ringkasan_ai'] = $this->generateRingkasan($request->deskripsi);
            }

            if ($request->hasFile('foto')) {
                if ($activity->foto && Storage::disk('public')->exists($activity->foto)) {
                    Storage::disk('public')->delete($activity->foto);
                }
                $data['foto'] = $request->file('foto')
                    ->store('daily_activities', 'public');
            }

            $activity->update($data);

            return redirect()->route('siswa.activity.index')
                ->with('success', 'Aktivitas berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function generateRingkasan(string $deskripsi): ?string
    {
        $apiKey = config('services.openai.key');

        if (!$apiKey) {
            return null;
        }

        $response = Http::withToken($apiKey)
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-4o-mini',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'Ringkas aktivitas siswa PKL menjadi 1 kalimat singkat dan formal.'
                    ],
                    [
                        'role' => 'user',
                        'content' => $deskripsi
                    ],
                ],
                'temperature' => 0.4,
                'max_tokens' => 60,
            ]);

        if ($response->failed()) {
            return null;
        }

        return $response->json('choices.0.message.content');
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
