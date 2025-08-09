<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use Illuminate\Support\Facades\hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session('login_id') && session('role')) {
        return redirect('/' . session('role') . '/dashboard');
        }

        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'id_login' => 'required',
            'password' => 'required'
        ]);

        $user = Login::where('id_login', $request->id_login)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            session(['login_id' => $user->id, 'role' => $user->role]);

            return redirect("/{$user->role}/dashboard");
        }

        return back()->with('error', 'ID Login atau Password salah!');
    }

    public function logout()
    {
        session()->flush();
        return redirect('/');
    }
}
