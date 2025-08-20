<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\TempatPKL;
use App\Models\DailyActivity;

class SiswaController extends Controller
{
    public function dashboard()
    {
        $login_id = session('login_id');

        $siswa = Siswa::where('login_id', $login_id)->first();
        $tempat = TempatPKL::where('login_id', $login_id)->first();
        $activities = DailyActivity::where('login_id', $login_id)->get();

        return view('siswa.dashboard', compact('siswa', 'tempat', 'activities'));
    }
}
