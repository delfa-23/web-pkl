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
        $siswas = Siswa::whereHas('tempats', function ($q) {
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
        $siswas = Siswa::whereHas('tempats', function ($q) {
            $q->where('siswa_tempat.status', 'proses');
        })->get();

        return view('surat.daftar_siswa_pengajuan', compact('siswas'));
    }



    public function showPencarian($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('surat.pengajuan', compact('siswa'));
    }

    public function downloadPencarian($id)
    {
        $siswa = Siswa::findOrFail($id);

        $pdf = \PDF::loadView('surat.pengajuan', compact('siswa'))
            ->setPaper('A4', 'portrait')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
            ])
            ->setOption('margin-top', 40)    // jarak dari atas
            ->setOption('margin-bottom', 40) // jarak dari bawah
            ->setOption('margin-left', 30)   // jarak dari kiri
            ->setOption('margin-right', 30); // jarak dari kanan

        return $pdf->download('pengajuan_' . $siswa->nama . '.pdf');
    }

    // ========================
    // Surat Pemberangkatan (status: diterima)
    // ========================
    public function daftarSiswaPemberangkatan()
    {
        $siswas = Siswa::whereHas('tempats', function ($q) {
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
        $siswas = Siswa::whereHas('tempats', function ($q) {
            $q->where('siswa_tempat.status', 'diterima');
        })->get();

        return view('surat.daftar_siswa_perjanjian', compact('siswas'));
    }

    public function showKeterangan($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('surat.perjanjian', compact('siswa'));
    }

    public function downloadKeterangan($id)
    {
        $siswa = Siswa::findOrFail($id);
        $pdf = PDF::loadView('surat.perjanjian', compact('siswa'));
        return $pdf->download('perjanjian_' . $siswa->nama . '.pdf');
    }
}
