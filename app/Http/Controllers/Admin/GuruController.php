<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Login;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $guru = Guru::with('login')
            ->whereHas('login', fn($q) => $q->where('role', 'guru'))
            ->when($request->search, function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                ->orWhere('nip', 'like', '%' . $request->search . '%')
                ->orWhere('nuptk', 'like', '%' . $request->search . '%')
                ->orWhere('jabatan', 'like', '%' . $request->search . '%');
            })
            ->get();

        return view('admin.guru.index', compact('guru'));
    }


    public function create()
    {
        return view('admin.guru.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'nip'      => 'nullable|string|max:50',
            'nuptk'    => 'nullable|string|max:50',
            'jabatan'  => 'required|string|max:100',
            'id_login' => 'required|string|unique:logins,id_login',
            'password' => 'required|string|min:3',
        ]);

        $login = Login::create([
            'id_login' => $request->id_login,
            'password' => bcrypt($request->password),
            'role'     => 'guru',
        ]);

        Guru::create([
            'login_id' => $login->id,
            'nama'     => $request->nama,
            'nip'      => $request->nip,
            'nuptk'    => $request->nuptk,
            'jabatan'  => $request->jabatan,
        ]);

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil ditambahkan');
    }

    public function edit(Guru $guru)
    {
        return view('admin.guru.edit', compact('guru'));
    }

    public function update(Request $request, Guru $guru)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'nip'      => 'nullable|string|max:50',
            'nuptk'    => 'nullable|string|max:50',
            'jabatan'  => 'required|string|max:100',
            'id_login' => 'nullable|string|unique:logins,id_login,' . $guru->login->id,
            'password' => 'nullable|string|min:3',
        ]);

        $loginData = [];

        if ($request->filled('id_login')) {
            $loginData['id_login'] = $request->id_login;
        }

        if ($request->filled('password')) {
            $loginData['password'] = bcrypt($request->password);
        }

        if (!empty($loginData)) {
            $guru->login->update($loginData);
        }

        $guru->update([
            'nama'    => $request->nama,
            'nip'     => $request->nip,
            'nuptk'   => $request->nuptk,
            'jabatan' => $request->jabatan,
        ]);

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil diupdate.');
    }


    public function destroy(Guru $guru)
    {
        $guru->login()->delete();
        $guru->delete();

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil dihapus.');
    }
}
