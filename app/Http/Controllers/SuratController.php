<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use PDF;

class SuratController extends Controller
{
    // ========================
    // Surat Izin Orang Tua
    // ========================
    public function daftarSiswaIzin()
    {
        $siswas = Siswa::all();
        return view('surat.daftar_siswa_izin_orangtua', compact('siswas'));
    }

    public function showIzin($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('surat.izin_orangtua', compact('siswa'));
    }

    public function downloadIzin($id)
    {
        $siswa = Siswa::findOrFail($id);
        $pdf = PDF::loadView('surat.izin_orangtua', compact('siswa'));
        return $pdf->download('izin_orangtua_' . $siswa->nama . '.pdf');
    }

    // ========================
    // Surat Pencarian
    // ========================
    public function daftarSiswaPencarian()
    {
        $siswas = Siswa::all();
        return view('surat.daftar_siswa_pencarian', compact('siswas'));
    }

    public function showPencarian($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('surat.pencarian', compact('siswa'));
    }

    public function downloadPencarian($id)
    {
        $siswa = Siswa::findOrFail($id);
        $pdf = \PDF::loadView('surat.pencarian', compact('siswa'));
        return $pdf->download('pencarian_' . $siswa->nama . '.pdf');
    }

    // ========================
    // Surat Pemberangkatan
    // ========================
    public function daftarSiswaPemberangkatan()
    {
        $siswas = Siswa::all();
        return view('surat.daftar_siswa_pemberangkatan', compact('siswas'));
    }

    // ========================
    // Surat Keterangan
    // ========================
    public function daftarSiswaKeterangan()
    {
        $siswas = Siswa::all();
        return view('surat.daftar_siswa_keterangan', compact('siswas'));
    }

    // ========================
    // Surat Peminatan
    // ========================
    public function daftarSiswaPeminatan()
    {
        $siswas = Siswa::all();
        return view('surat.daftar_siswa_peminatan', compact('siswas'));
    }
}
