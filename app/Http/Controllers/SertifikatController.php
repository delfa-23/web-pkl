<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Siswa;

class SertifikatController extends Controller
{
    // 🔹 Lihat Sertifikat (stream PDF ke browser)
    public function lihat($id)
    {
        $siswa = Siswa::with('tempats')->findOrFail($id);

        $pdf = Pdf::loadView('sertifikat.template', compact('siswa'))
                  ->setPaper('A4', 'landscape');

        return $pdf->stream('Sertifikat-'.$siswa->nama.'.pdf');
    }

    // 🔹 Download Sertifikat (langsung download file PDF)
    public function download($id)
    {
        $siswa = Siswa::with('tempats')->findOrFail($id);

        $pdf = Pdf::loadView('sertifikat.template', compact('siswa'))
                  ->setPaper('A4', 'landscape');

        return $pdf->download('Sertifikat-'.$siswa->nama.'-'.$siswa->tempats->first()->nama_perusahaan.'.pdf');
    }
}
