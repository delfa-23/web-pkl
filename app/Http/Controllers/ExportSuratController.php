<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\SimpleType\Jc;

class ExportSuratController extends Controller
{
    public function exportSuratIzinOrtu($id)
    {
        $siswa = Siswa::findOrFail($id);

        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        // === PENGATURAN KERTAS ===
        $section = $phpWord->addSection([
            'marginTop' => 1200, // jarak isi ke kop
            'marginBottom' => 800, // jarak isi ke footer
            'marginLeft' => 1000,
            'marginRight' => 1000,
        ]);

        // === HEADER / KOP ===
        $header = $section->addHeader();
        $header->addImage(public_path('assets/img/kop.png'), [
            'width' => 610, // lebar pas buat A4
            'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER,
            'marginTop' => 0,
            'wrappingStyle' => 'behind', // biar di belakang teks
        ]);

        // === FOOTER ===
        $footer = $section->addFooter();
        $footer->addImage(public_path('assets/img/footer.png'), [
            'width' => 610,
            'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER,
            'wrappingStyle' => 'behind',
        ]);

        // === ISI SURAT ===
        $section->addTextBreak(3);
        $section->addText('SURAT IZIN ORANG TUA/WALI', ['bold' => true, 'underline' => 'single'], ['align' => 'center']);
        $section->addTextBreak(1);

        $section->addText('Yang bertanda tangan di bawah ini:');
        $section->addText('Nama Orang Tua/Wali : ...................................................');
        $section->addText('Alamat : .....................................................................................');
        $section->addText('No. HP : .....................................................................................');
        $section->addTextBreak(1);

        $section->addText('adalah orang tua/wali dari:');
        $section->addText("Nama Siswa : {$siswa->nama}");
        $section->addText("NIS : {$siswa->nis}");
        $section->addText("Kelas : {$siswa->kelas}");
        $section->addText("Jurusan : {$siswa->jurusan}");
        $section->addTextBreak(1);

        $section->addText(
            "Dengan ini memberikan izin kepada putra/putri kami untuk mengikuti Praktik Kerja Lapangan (PKL) yang diselenggarakan oleh SMK-IT As-Syifa Boarding School pada:"
        );
        $section->addText("Tempat PKL : " . ($siswa->tempatAktif()->nama_perusahaan ?? '..........................'));
        $section->addText("Alamat Perusahaan : " . ($siswa->tempatAktif()->alamat_perusahaan ?? '..........................'));
        $section->addText("Waktu Pelaksanaan : .......................... s/d ..........................");
        $section->addTextBreak(1);

        $section->addText(
            "Saya selaku orang tua/wali memahami bahwa kegiatan PKL ini merupakan bagian dari program pendidikan sekolah, serta menyetujui putra/putri kami untuk mengikuti kegiatan tersebut dengan penuh tanggung jawab."
        );
        $section->addText(
            "Demikian surat izin ini dibuat dengan sebenarnya, untuk digunakan sebagaimana mestinya."
        );

        $section->addTextBreak(2);
        $section->addText("Subang, ................. 2025", null, ['align' => 'right']);
        $section->addText("Orang Tua/Wali,", null, ['align' => 'right']);
        $section->addTextBreak(3);
        $section->addText("(.............................................)", null, ['align' => 'right']);

        // === DOWNLOAD ===
        $filename = 'Surat_Izin_Orang_Tua_' . $siswa->nama . '.docx';
        $tempFile = tempnam(sys_get_temp_dir(), 'word');
        $phpWord->save($tempFile, 'Word2007');

        return response()->download($tempFile, $filename)->deleteFileAfterSend(true);
    }
    public function exportSuratPengajuanTempatPKL($id)
    {
        $siswa = Siswa::findOrFail($id);
        $phpWord = new PhpWord();

        // === SETUP HALAMAN ===
        $section = $phpWord->addSection([
            'marginTop' => 200,  // 🟢 pas biar isi deket kop
            'marginBottom' => 600,
            'marginLeft' => 1000,
            'marginRight' => 1000,
        ]);

        // === KOP SURAT ===
        $header = $section->addHeader();
        $header->addImage(public_path('assets/img/kop.png'), [
            'width' => 610,
            'alignment' => Jc::CENTER,
            'positioning' => \PhpOffice\PhpWord\Style\Image::POSITION_ABSOLUTE,
            'posVertical' => \PhpOffice\PhpWord\Style\Image::POS_TOP,
            'posVerticalRel' => 'page',
            'posHorizontal' => \PhpOffice\PhpWord\Style\Image::POS_CENTER,
            'posHorizontalRel' => 'page',
        ]);

        // === FOOTER SURAT ===
        $footer = $section->addFooter();
        $footer->addImage(public_path('assets/img/footer.png'), [
            'width' => 610,
            'alignment' => Jc::CENTER,
            'positioning' => \PhpOffice\PhpWord\Style\Image::POSITION_ABSOLUTE,
            'posVertical' => \PhpOffice\PhpWord\Style\Image::POS_BOTTOM,
            'posVerticalRel' => 'page',
            'posHorizontal' => \PhpOffice\PhpWord\Style\Image::POS_CENTER,
            'posHorizontalRel' => 'page',
        ]);

        // === ISI SURAT ===
        $section->addTextBreak(4); // jarak dari kop ke judul

        $section->addText('SURAT PENGAJUAN TEMPAT PKL', ['bold' => true], ['align' => 'center']);
        $section->addTextBreak(1);

        $section->addText('Subang, ' . now()->translatedFormat('d F Y'), null, ['align' => 'right']);
        $section->addText('Nomor : ............');
        $section->addText('Lamp. : -');
        $section->addText('Perihal : Pengajuan Tempat PKL');
        $section->addTextBreak(1);

        $section->addText('Kepada Yth,');
        $section->addText('Bapak/Ibu Pimpinan DUDI ................................');
        $section->addText('Di tempat');
        $section->addTextBreak(1);

        $section->addText('Dengan hormat,');
        $section->addText(
            'Sesuai dengan Permendikbud No. 50 Tahun 2020 tentang Praktik Kerja Lapangan (PKL) bagi peserta didik, bahwa proses pembelajaran di SMK harus melibatkan Dunia Industri dalam pembimbingan PKL.',
            null,
            ['align' => 'justify']
        );

        $section->addTextBreak(1);
        $section->addText('Saya yang bertandatangan di bawah ini:');
        $section->addText('Nama : ' . ($siswa->nama ?? '...................'), null, ['indent' => 500]);
        $section->addText('NIS : ' . ($siswa->nis ?? '...................'), null, ['indent' => 500]);
        $section->addText('Jurusan : ' . ($siswa->jurusan ?? '...................'), null, ['indent' => 500]);
        $section->addText('Kelas : ' . ($siswa->kelas ?? '...................'), null, ['indent' => 500]);

        $section->addTextBreak(1);
        $section->addText(
            'Dengan ini bermaksud mengajukan permohonan Praktik Kerja Lapangan di perusahaan/instansi/industri yang Bapak/Ibu pimpin.',
            null,
            ['align' => 'justify']
        );

        $section->addText(
            'Demikian surat ini disampaikan. Besar harapan agar kami dapat diterima di tempat Bapak/Ibu pimpin.',
            null,
            ['align' => 'justify']
        );

        $section->addTextBreak(2);
        $section->addText('Mengetahui,', null, ['align' => 'center']);
        $section->addText('Kepala SMK-IT As-Syifa Boarding School,', null, ['align' => 'center']);
        $section->addTextBreak(3);
        $section->addText('H. AGUS NUR PURWANTO, S.T.', ['bold' => true], ['align' => 'center']);
        $section->addText('NIY. ...................................', null, ['align' => 'center']);

        // === DOWNLOAD FILE ===
        $filename = 'Surat_Pengajuan_Tempat_PKL_' . $siswa->nama . '.docx';
        $tempFile = tempnam(sys_get_temp_dir(), 'word');
        $phpWord->save($tempFile, 'Word2007');

        return response()->download($tempFile, $filename)->deleteFileAfterSend(true);
    }
}
