<?php

namespace App\Http\Controllers;

use App\Models\DailyActivity;
use App\Models\Guru;
use App\Models\Login;
use App\Models\Siswa;
use Illuminate\Http\Request;

class AdminDailyActivityController extends Controller
{
    public function index(Request $request)
    {
        $query = DailyActivity::with(['siswa.tempatAktif.guru']);

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        if ($request->filled('status_verifikasi')) {
            $query->where('status_verifikasi', $request->status_verifikasi);
        }

        if ($request->filled('siswa_id')) {
            $query->where('login_id', $request->siswa_id);
        }

        if ($request->filled('guru_id')) {
            $query->whereHas('siswa.tempatAktif', function ($q) use ($request) {
                $q->where('guru_id', $request->guru_id);
            });
        }

        $activities = $query->paginate(10)->appends(request()->query());

        $gurus  = Guru::orderBy('nama')->get();
        $siswas = Siswa::orderBy('nama')->get();

        return view('admin.daily', compact(
            'activities',
            'gurus',
            'siswas'
        ));
    }
}
