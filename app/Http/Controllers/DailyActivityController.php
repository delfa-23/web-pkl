<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;
use App\Models\DailyActivity;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class DailyActivityController extends Controller
{
    public function index()
    {
        $siswa = \App\Models\Siswa::with(['tempats.guru'])
            ->where('login_id', session('login_id'))
            ->first();

        $activities = DailyActivity::where('login_id', session('login_id'))
            ->orderBy('tanggal', 'desc')
            ->get();

        // ambil daily activity terakhir
        $lastActivity = DailyActivity::where('login_id', session('login_id'))
            ->orderBy('tanggal', 'desc')
            ->first();

        return view('siswa.activity.index', compact(
            'siswa',
            'activities',
            'lastActivity'
        ));
    }

    public function create()
    {
        $lastActivity = DailyActivity::where('login_id', session('login_id'))
            ->latest('tanggal')
            ->first();

        if ($lastActivity && $lastActivity->status_verifikasi !== 'diterima') {
            return redirect()->route('siswa.activity.index')
                ->with(
                    'error',
                    'Daily activity tanggal ' .
                        $lastActivity->tanggal .
                        ' belum diterima pembina dan harus diperbaiki.'
                );
        }

        return view('siswa.activity.create');
    }


    // Simpan activity baru
    public function store(Request $request)
    {

        $lastActivity = DailyActivity::where('login_id', session('login_id'))
            ->latest('tanggal')
            ->first();

        if ($lastActivity && $lastActivity->status_verifikasi !== 'diterima') {
            return redirect()->back()
                ->with('error', 'Masih ada daily activity yang belum diterima pembina.');
        }

        $request->validate([
            'tanggal' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $exists = DailyActivity::where('login_id', session('login_id'))
                        ->whereDate('tanggal', $value)
                        ->exists();

                    if ($exists) {
                        $fail('Daily activity untuk tanggal ini sudah ada. Hanya boleh 1 aktivitas per hari.');
                    }
                }
            ],
            'waktu_mulai'   => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
            'kegiatan'      => 'required|string',
            'deskripsi'     => 'nullable|string',
            'foto'          => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'waktu_selesai.after' => 'Jam selesai harus lebih besar dari jam mulai.',
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
                'status_verifikasi' => 'pending',
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
        $activity = DailyActivity::where('id', $id)
            ->where('login_id', session('login_id'))
            ->firstOrFail();

        if ($activity->status_verifikasi === 'diterima') {
            return redirect()
                ->route('siswa.activity.index')
                ->with('error', 'Aktivitas yang sudah diterima tidak bisa diedit.');
        }

        return view('siswa.activity.edit', compact('activity'));
    }


    public function update(Request $request, $id)
    {
        $activity = DailyActivity::where('id', $id)
            ->where('login_id', session('login_id'))
            ->firstOrFail();

        // 🔒 kalau sudah diterima, stop
        if ($activity->status_verifikasi === 'diterima') {
            return back()->with('error', 'Aktivitas yang sudah diterima tidak bisa diubah.');
        }

        $request->validate([
            'tanggal' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($id) {
                    $exists = DailyActivity::where('login_id', session('login_id'))
                        ->whereDate('tanggal', $value)
                        ->where('id', '!=', $id)
                        ->exists();

                    if ($exists) {
                        $fail('Daily activity untuk tanggal ini sudah ada. Tidak boleh duplikat.');
                    }
                }
            ],
            'waktu_mulai'   => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
            'kegiatan'      => 'required|string',
            'deskripsi'     => 'nullable|string',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'waktu_selesai.after' => 'Jam selesai harus lebih besar dari jam mulai.',
        ]);


        $data = $request->only([
            'tanggal',
            'waktu_mulai',
            'waktu_selesai',
            'kegiatan',
            'deskripsi',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('daily_activities', 'public');
        }

        // 🔴 INI YANG SEBELUMNYA BIKIN STUCK
        $data['status_verifikasi'] = 'pending';
        $data['catatan_pembimbing'] = null;

        $activity->update($data);

        return redirect()
            ->route('siswa.activity.index')
            ->with('success', 'Aktivitas berhasil diperbarui dan dikirim ulang untuk verifikasi.');
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

    public function batalkan($id)
    {
        $activity = DailyActivity::findOrFail($id);

        if ($activity->status_verifikasi !== 'diterima') {
            return back()->with('error', 'Hanya aktivitas diterima yang bisa dibatalkan.');
        }

        $activity->update([
            'status_verifikasi' => 'ditolak',
            'catatan_pembina'   => 'Status diterima dibatalkan oleh pembimbing',
        ]);

        return back()->with('success', 'Status berhasil dibatalkan.');
    }


    public function verifikasi(Request $request, $id)
    {
        $activity = DailyActivity::findOrFail($id);

        // Validasi
        if ($request->status_verifikasi === 'ditolak' && !$request->catatan_pembina) {
            return back()->with('error', 'Catatan wajib diisi jika menolak.');
        }

        // Update status
        $activity->update([
            'status_verifikasi' => $request->status_verifikasi,
            'catatan_pembina'   => $request->status_verifikasi === 'ditolak'
                ? $request->catatan_pembina
                : null,
        ]);

        return back()->with('success', 'Status berhasil diperbarui');
    }
}
