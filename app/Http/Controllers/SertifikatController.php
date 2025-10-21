<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\TemplateProcessor;
use App\Models\Siswa;

class SertifikatController extends Controller
{
    public function download($id)
    {
        $siswa = Siswa::with('tempats')->findOrFail($id);
        $templatePath = public_path('assets/docx/SERTIFIKAT PKL.docx');

        if (!file_exists($templatePath)) {
            abort(404, 'Template sertifikat tidak ditemukan');
        }

        $template = new TemplateProcessor($templatePath);

        // 🔹 Ambil data
        $nama = $siswa->nama ?? '................';
        $noSertifikat = 'PKL-' . strtoupper(substr($siswa->nama, 0, 3)) . '-' . rand(100, 999);
        $namaPerusahaan = optional($siswa->tempatAktif())->nama_perusahaan ?? '................';

        // 🔹 Ganti placeholder di Word
        $template->setValue('no_sertifikat', $noSertifikat);
        $template->setValue('nama_siswa', $nama);
        $template->setValue('nama_perusahaan', $namaPerusahaan);

        // 🔹 Simpan file sementara & kirim ke browser
        $output = tempnam(sys_get_temp_dir(), 'sertifikat_');
        $template->saveAs($output);

        return response()->download($output, 'Sertifikat-' . $nama . '.docx')->deleteFileAfterSend(true);
    }
}
