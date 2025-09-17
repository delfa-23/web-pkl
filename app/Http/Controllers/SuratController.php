<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use PDF;

class SuratController extends Controller
{
    // ========================
    // Surat Izin Orang Tua (status: proses)
    // ========================
    public function daftarSiswaIzin()
    {
        $siswas = Siswa::whereHas('tempats', function($q) {
            $q->where('siswa_tempat.status', 'proses'); // filter status di pivot
        })->get();

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
    // Surat Pencarian Tempat PKL (status: proses)
    // ========================
    public function daftarSiswaPencarian()
    {
        $siswas = Siswa::whereHas('tempats', function($q) {
            $q->where('siswa_tempat.status', 'proses');
        })->get();

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
        $pdf = PDF::loadView('surat.pencarian', compact('siswa'));
        return $pdf->download('pencarian_' . $siswa->nama . '.pdf');
    }

    // ========================
    // Surat Pemberangkatan (status: diterima)
    // ========================
    public function daftarSiswaPemberangkatan()
{
    $siswas = Siswa::whereHas('tempats', function($q) {
        $q->where('siswa_tempat.status', 'diterima');
    })->get();

    return view('surat.daftar_siswa_pemberangkatan', compact('siswas'));
}

    public function showPemberangkatan($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('surat.pemberangkatan', compact('siswa'));
    }

    public function downloadPemberangkatan($id)
    {
        $siswa = Siswa::findOrFail($id);
        $pdf = PDF::loadView('surat.pemberangkatan', compact('siswa'));
        return $pdf->download('pemberangkatan_' . $siswa->nama . '.pdf');
    }

    // ========================
    // Surat Keterangan PKL (status: diterima)
    // ========================
    public function daftarSiswaKeterangan()
    {
        $siswas = Siswa::whereHas('tempats', function($q) {
            $q->where('siswa_tempat.status', 'diterima');
        })->get();

        return view('surat.daftar_siswa_keterangan', compact('siswas'));
    }

    public function showKeterangan($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('surat.keterangan', compact('siswa'));
    }

    public function downloadKeterangan($id)
    {
        $siswa = Siswa::findOrFail($id);
        $pdf = PDF::loadView('surat.keterangan', compact('siswa'));
        return $pdf->download('keterangan_' . $siswa->nama . '.pdf');
    }
}
