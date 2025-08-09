<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Form tambah user
    public function create()
    {
        return view('user.create');
    }

    // Simpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'id_login' => 'required|unique:logins,id_login',
            'password' => 'required|min:4',
            'role' => 'required|in:admin,guru,siswa'
        ]);

        Login::create([
            'id_login' => $request->id_login,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect()->back()->with('success', 'User berhasil dibuat!');
    }
}

