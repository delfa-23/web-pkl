<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnggotaTempatController extends Controller
{
    // Kirim undangan
    public function undangSiswa(Request $request, $tempatId)
    {
        $siswaId = $request->siswa_id;

        \DB::table('siswa_tempat')->updateOrInsert(
            ['siswa_id' => $siswaId, 'tempat_pkl_id' => $tempatId],
            ['status' => 'pending', 'updated_at' => now()]
        );

        return back()->with('success', 'Undangan dikirim.');
    }

    // Respon undangan
    public function responUndangan($pivotId, $aksi)
    {
        $status = $aksi == 'terima' ? 'approved' : 'rejected';

        \DB::table('siswa_tempat')->where('id', $pivotId)
            ->update(['status' => $status, 'updated_at' => now()]);

        return back()->with('success', 'Undangan ' . $aksi);
    }

    // Admin tambah langsung
    public function adminTambah($siswaId, $tempatId)
    {
        \DB::table('siswa_tempat')->updateOrInsert(
            ['siswa_id' => $siswaId, 'tempat_pkl_id' => $tempatId],
            ['status' => 'approved', 'updated_at' => now()]
        );

        return back()->with('success', 'Siswa langsung ditambahkan.');
    }

}
