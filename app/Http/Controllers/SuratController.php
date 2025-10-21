<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use Illuminate\Contracts\View\View;
use PDF;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\IOFactory;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpWord\Shared\Html;

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
    public function exportSuratIzinOrtu($id)
    {
        $siswa = Siswa::findOrFail($id);

        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        // === KERTAS & MARGIN ===
        $section = $phpWord->addSection([
            'marginTop' => -100,
            'marginBottom' => 600,
            'marginLeft' => 1000,
            'marginRight' => 1000,
        ]);

        // === HEADER (KOP SURAT) ===
        $header = $section->addHeader();
        $header->addImage(public_path('assets/img/kop.png'), [
            'width' => 610,
            'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER,
            'positioning' => \PhpOffice\PhpWord\Style\Image::POSITION_ABSOLUTE,
            'posVertical' => \PhpOffice\PhpWord\Style\Image::POS_TOP,
            'posVerticalRel' => 'page',
            'posHorizontal' => \PhpOffice\PhpWord\Style\Image::POS_CENTER,
            'posHorizontalRel' => 'page',
        ]);

        // === FOOTER ===
        $footer = $section->addFooter();
        $footer->addImage(public_path('assets/img/footer.png'), [
            'width' => 610,
            'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER,
            'positioning' => \PhpOffice\PhpWord\Style\Image::POSITION_ABSOLUTE,
            'posVertical' => \PhpOffice\PhpWord\Style\Image::POS_BOTTOM,
            'posVerticalRel' => 'page',
            'posHorizontal' => \PhpOffice\PhpWord\Style\Image::POS_CENTER,
            'posHorizontalRel' => 'page',
        ]);

        // === ISI SURAT ===
        $section->addTextBreak(6); // 🟢 ubah jumlah baris biar pas di bawah kop
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

        $section->addTextBreak(1);
        $section->addText("Subang, ................. 2025", null, ['align' => 'right']);
        $section->addText("Orang Tua/Wali,", null, ['align' => 'right']);
        $section->addTextBreak(2);
        $section->addText("(.............................................)", null, ['align' => 'right']);

        // === DOWNLOAD ===
        $filename = 'Surat_Izin_Orang_Tua_' . $siswa->nama . '.docx';
        $tempFile = tempnam(sys_get_temp_dir(), 'word');
        $phpWord->save($tempFile, 'Word2007');

        return response()->download($tempFile, $filename)->deleteFileAfterSend(true);
    }

    public function exportSuratPengajuanPkl($id)
    {
        $siswa = Siswa::findOrFail($id);
        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        // === KERTAS & MARGIN ===
        $section = $phpWord->addSection([
            'marginTop' => -100,
            'marginBottom' => 600,
            'marginLeft' => 1000,
            'marginRight' => 1000,
        ]);

        // === HEADER (KOP SURAT) ===
        $header = $section->addHeader();
        $header->addImage(public_path('assets/img/kop.png'), [
            'width' => 610,
            'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER,
            'positioning' => \PhpOffice\PhpWord\Style\Image::POSITION_ABSOLUTE,
            'posVertical' => \PhpOffice\PhpWord\Style\Image::POS_TOP,
            'posVerticalRel' => 'page',
            'posHorizontal' => \PhpOffice\PhpWord\Style\Image::POS_CENTER,
            'posHorizontalRel' => 'page',
        ]);

        // === FOOTER ===
        $footer = $section->addFooter();
        $footer->addImage(public_path('assets/img/footer.png'), [
            'width' => 610,
            'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER,
            'positioning' => \PhpOffice\PhpWord\Style\Image::POSITION_ABSOLUTE,
            'posVertical' => \PhpOffice\PhpWord\Style\Image::POS_BOTTOM,
            'posVerticalRel' => 'page',
            'posHorizontal' => \PhpOffice\PhpWord\Style\Image::POS_CENTER,
            'posHorizontalRel' => 'page',
        ]);

        // === ISI SURAT ===
        $section->addTextBreak(6); // 🔼 naikkan posisi isi surat biar pas di bawah kop
        $section->addText('SURAT PENGAJUAN TEMPAT PKL', [
            'bold' => true,
            'underline' => 'single',
            'size' => 12,
        ], ['align' => 'center']);

        $section->addText("Subang, " . now()->translatedFormat('d F Y'), null, ['align' => 'right']);
        $section->addText("Nomor : ............");
        $section->addText("Lamp. : -");
        $section->addText("Perihal : Pengajuan Tempat PKL");
        $section->addTextBreak(1);

        $section->addText("Kepada Yth,");
        $company = optional($siswa->tempatAktif())->nama_perusahaan ?? '...................................';
        $section->addText("Bapak/Ibu Pimpinan " . $company);
        $section->addText("Di tempat");
        $section->addTextBreak(1);

        $section->addText("Dengan hormat,");
        $section->addText(
            "      Sesuai dengan Permendikbud No. 50 Tahun 2020 tentang Praktik Kerja Lapangan (PKL) bagi peserta didik, bahwa proses pembelajaran di SMK harus melibatkan Dunia Industri dalam pembimbingan PKL."
        );
        $section->addTextBreak(1);

        $section->addText("Saya yang bertandatangan di bawah ini:");
        $section->addText("      Nama     : " . ($siswa->nama ?? '...................'));
        $section->addText("      NIS      : " . ($siswa->nis ?? '...................'));
        $section->addText("      Jurusan  : " . ($siswa->jurusan ?? '...................'));
        $section->addText("      Kelas    : " . ($siswa->kelas ?? '...................'));
        $section->addTextBreak(1);

        $section->addText(
            "      Dengan ini bermaksud mengajukan permohonan Praktik Kerja Lapangan di perusahaan/instansi/industri yang Bapak/Ibu pimpin."
        );
        $section->addTextBreak(1);
        $section->addText(
            "      Demikian surat ini disampaikan. Besar harapan agar kami dapat diterima di tempat Bapak/Ibu pimpin."
        );

        // === TANDA TANGAN ===
        $section->addText("Mengetahui,", ['bold' => true], ['align' => 'center']);
        $section->addText("Kepala SMK-IT As-Syifa Boarding School,", null, ['align' => 'center']);
        $section->addTextBreak(1);
        $section->addText("H. AGUS NUR PURWANTO, S.T.", ['bold' => true], ['align' => 'center']);
        $section->addText("NIY. ...................................", null, ['align' => 'center']);

        // === DOWNLOAD FILE ===
        $filename = 'Surat_Pengajuan_Tempat_PKL_' . $siswa->nama . '.docx';
        $tempFile = tempnam(sys_get_temp_dir(), 'word');
        $phpWord->save($tempFile, 'Word2007');

        return response()->download($tempFile, $filename)->deleteFileAfterSend(true);
    }
    public function exportSuratPemberangkatan($id)
    {
        $siswa = Siswa::findOrFail($id);
        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        // === KERTAS & MARGIN ===
        $section = $phpWord->addSection([
            'marginTop' => -100,       // biar isi deket kop
            'marginBottom' => 600,
            'marginLeft' => 1000,
            'marginRight' => 1000,
        ]);

        // === HEADER (KOP SURAT) ===
        $header = $section->addHeader();
        $header->addImage(public_path('assets/img/kop.png'), [
            'width' => 610,
            'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER,
            'positioning' => \PhpOffice\PhpWord\Style\Image::POSITION_ABSOLUTE,
            'posVertical' => \PhpOffice\PhpWord\Style\Image::POS_TOP,
            'posVerticalRel' => 'page',
            'posHorizontal' => \PhpOffice\PhpWord\Style\Image::POS_CENTER,
            'posHorizontalRel' => 'page',
        ]);

        // === FOOTER ===
        $footer = $section->addFooter();
        $footer->addImage(public_path('assets/img/footer.png'), [
            'width' => 610,
            'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER,
            'positioning' => \PhpOffice\PhpWord\Style\Image::POSITION_ABSOLUTE,
            'posVertical' => \PhpOffice\PhpWord\Style\Image::POS_BOTTOM,
            'posVerticalRel' => 'page',
            'posHorizontal' => \PhpOffice\PhpWord\Style\Image::POS_CENTER,
            'posHorizontalRel' => 'page',
        ]);

        // === ISI SURAT ===
        $section->addTextBreak(6);
        $section->addText(
            'SURAT PENGANTAR KEBERANGKATAN',
            ['bold' => true, 'underline' => 'single'],
            ['align' => 'center']
        );
        $section->addText('Nomor: ....../SMK-IT/AS-SYIFA/............/20....', [], ['align' => 'center']);

        $section->addText('Yang bertanda tangan di bawah ini:');
        $section->addText('Nama : ............................................................');
        $section->addText('Jabatan : .........................................................');
        $section->addText('Sekolah : SMK-IT As-Syifa Boarding School');
        $section->addTextBreak(1);

        $section->addText('Dengan ini menerangkan bahwa:');
        $section->addText("Nama Siswa : {$siswa->nama}");
        $section->addText("NIS : {$siswa->nis}");
        $section->addText("Kelas : {$siswa->kelas}");
        $section->addText("Jurusan : {$siswa->jurusan}");

        $section->addText('adalah benar siswa SMK-IT As-Syifa Boarding School yang akan melaksanakan Praktik Kerja Lapangan (PKL) di:');
        $company = optional($siswa->tempatAktif())->nama_perusahaan ?? '..........................';
        $address = optional($siswa->tempatAktif())->alamat_perusahaan ?? '..........................';
        $section->addText('Tempat PKL : ' . $company);
        $section->addText('Alamat Perusahaan : ' . $address);
        $section->addText('Waktu PKL : .......................... s/d ..........................');
        $section->addTextBreak(1);

        $section->addText(
            'Sehubungan dengan itu, kami mohon kepada pihak perusahaan/instansi agar dapat menerima siswa tersebut untuk melaksanakan PKL sesuai ketentuan yang berlaku.'
        );
        $section->addText(
            'Demikian surat pengantar ini dibuat untuk dipergunakan sebagaimana mestinya. Atas perhatian dan kerja samanya kami ucapkan terima kasih.'
        );
        $section->addText('Wassalamu’alaikum Wr. Wb.');
        $section->addTextBreak(1);

        $section->addText("Mengetahui,", ['bold' => true], ['alignment' => 'center']);
        $section->addText("Kepala SMK-IT As-Syifa Boarding School,", [], ['alignment' => 'center']);
        $section->addTextBreak(2);
        $section->addText("H. AGUS NUR PURWANTO, S.T.", ['bold' => true], ['alignment' => 'center']);
        $section->addText("NIY. ...................................", [], ['alignment' => 'center']);

        // === DOWNLOAD ===
        $filename = 'Surat_Pemberangkatan_' . $siswa->nama . '.docx';
        $tempFile = tempnam(sys_get_temp_dir(), 'word');
        $phpWord->save($tempFile, 'Word2007');

        return response()->download($tempFile, $filename)->deleteFileAfterSend(true);
    }

    public function exportSuratPerjanjian($id)
    {
        $siswa = Siswa::findOrFail($id);
        $perusahaan = $siswa->tempatAktif()->nama_perusahaan ?? '(Nama Perusahaan)';

        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        // === PENGATURAN KERTAS & MARGIN ===
        $sectionStyle = [
            'marginTop' => 1200,   // biar isi gak nabrak kop
            'marginBottom' => 800, // cukup buat footer
            'marginLeft' => 1000,
            'marginRight' => 1000,
        ];

        // === HEADER (KOP) ===
        $phpWord->addSection($sectionStyle);
        $section = $phpWord->addSection($sectionStyle);
        $header = $section->addHeader();
        $header->addImage(public_path('assets/img/kop.png'), [
            'width' => 610,
            'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER,
            'positioning' => \PhpOffice\PhpWord\Style\Image::POSITION_ABSOLUTE,
            'posVertical' => \PhpOffice\PhpWord\Style\Image::POS_TOP,
            'posVerticalRel' => 'page',
            'posHorizontal' => \PhpOffice\PhpWord\Style\Image::POS_CENTER,
            'posHorizontalRel' => 'page',
        ]);

        // === FOOTER ===
        $footer = $section->addFooter();
        $footer->addImage(public_path('assets/img/footer.png'), [
            'width' => 610,
            'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER,
            'positioning' => \PhpOffice\PhpWord\Style\Image::POSITION_ABSOLUTE,
            'posVertical' => \PhpOffice\PhpWord\Style\Image::POS_BOTTOM,
            'posVerticalRel' => 'page',
            'posHorizontal' => \PhpOffice\PhpWord\Style\Image::POS_CENTER,
            'posHorizontalRel' => 'page',
        ]);

        // ====================== HALAMAN 1 ======================
        $section->addTextBreak(4);
        $section->addText('PERJANJIAN KERJASAMA', ['bold' => true, 'underline' => 'single'], ['align' => 'center']);
        $section->addText('ANTARA', null, ['align' => 'center']);
        $section->addText('SMK-IT AS-SYIFA BOARDING SCHOOL DENGAN', null, ['align' => 'center']);
        $section->addText(strtoupper($perusahaan), null, ['align' => 'center']);
        $section->addText('TENTANG', null, ['align' => 'center']);
        $section->addText('PENYELENGGARAAN PRAKTEK KERJA LAPANGAN', null, ['align' => 'center']);
        $section->addTextBreak(1);
        $section->addText('No. ............................................................', null, ['align' => 'center']);
        $section->addText('No. (dari DUDI) .................................................', null, ['align' => 'center']);
        $section->addTextBreak(2);

        $section->addText('Yang bertanda tangan di bawah ini:');
        $section->addText('Nama : H. Agus Nur Purwanto, S.T.');
        $section->addText('NIP : ..............................................');
        $section->addText('Jabatan : Kepala SMK-IT As-Syifa Boarding School');
        $section->addText('Alamat : Kp. Kumpay RT/RW 06/02 Desa Kumpay, Kec. Jalancagak, Kab. Subang');
        $section->addText('Selanjutnya disebut sebagai PIHAK PERTAMA.');
        $section->addTextBreak(1);
        $section->addText('Nama : ..............................................');
        $section->addText('Jabatan : ..............................................');
        $section->addText('Alamat : ..............................................');
        $section->addText('Telepon : ..............................................');
        $section->addText('Selanjutnya disebut sebagai PIHAK KEDUA.');
        $section->addTextBreak(1);
        $section->addText(
            'Kedua belah pihak sepakat mengadakan kerjasama dalam rangka pelaksanaan PRAKTEK KERJA LAPANGAN (PKL) sebagaimana dituangkan dalam pasal-pasal berikut:'
        );

        // ====================== HALAMAN 2 ======================
        $section = $phpWord->addSection($sectionStyle);
        $section->addHeader()->addImage(public_path('assets/img/kop.png'), [
            'width' => 610,
            'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER,
        ]);
        $section->addFooter()->addImage(public_path('assets/img/footer.png'), [
            'width' => 610,
            'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER,
        ]);

        $section->addText('Pasal 1 - TUJUAN', ['bold' => true], ['align' => 'center']);
        $section->addText('Kerjasama ini bertujuan untuk meningkatkan mutu sumber daya manusia melalui peningkatan kualitas pendidikan SMK.');
        $section->addTextBreak(1);

        $section->addText('Pasal 2 - LINGKUP KERJASAMA', ['bold' => true], ['align' => 'center']);
        $section->addText('PIHAK PERTAMA:');
        $section->addListItem('Menyiapkan siswa untuk PKL sesuai perencanaan yang disetujui.');
        $section->addListItem('Menyiapkan dokumen administrasi PKL.');
        $section->addListItem('Mengkoordinasikan pelaksanaan PKL.');
        $section->addListItem('Melakukan evaluasi pelaksanaan PKL.');
        $section->addTextBreak(1);
        $section->addText('PIHAK KEDUA:');
        $section->addListItem('Memberikan kesempatan bagi siswa PKL.');
        $section->addListItem('Menyiapkan pembimbing PKL.');
        $section->addListItem('Menyiapkan sarana dan prasarana.');
        $section->addListItem('Membimbing dan melatih siswa PKL.');
        $section->addListItem('Menandatangani jurnal dan sertifikat PKL.');
        $section->addListItem('Menjamin keamanan dan keselamatan peserta PKL.');
        $section->addTextBreak(1);

        $section->addText('Pasal 3 - PELAKSANAAN', ['bold' => true], ['align' => 'center']);
        $section->addText('Kegiatan PKL dilakukan selama 6 (enam) bulan, dimulai 1 Januari s.d 30 Juni 2026.');
        $section->addText('Penugasan disesuaikan dengan kompetensi siswa.');

        // ====================== HALAMAN 3 ======================
        $section = $phpWord->addSection($sectionStyle);
        $section->addHeader()->addImage(public_path('assets/img/kop.png'), ['width' => 610]);
        $section->addFooter()->addImage(public_path('assets/img/footer.png'), ['width' => 610]);

        $section->addText('Pasal 4 - DASAR HUKUM', ['bold' => true], ['align' => 'center']);
        $section->addListItem('UU No. 20 Tahun 2003 tentang Sistem Pendidikan Nasional.');
        $section->addListItem('Permendikbud No. 50 Tahun 2020 tentang PKL.');
        $section->addListItem('Panduan PKL Kurikulum Merdeka Revisi 2023.');
        $section->addTextBreak(1);

        $section->addText('Pasal 5 - JANGKA WAKTU', ['bold' => true], ['align' => 'center']);
        $section->addText('Kerjasama berlaku selama 4 tahun dan dapat diperpanjang sesuai kesepakatan.');
        $section->addTextBreak(1);

        $section->addText('Pasal 6 - LAIN-LAIN', ['bold' => true], ['align' => 'center']);
        $section->addText('Perselisihan diselesaikan secara musyawarah.');

        // ====================== HALAMAN 4 ======================
        $section = $phpWord->addSection($sectionStyle);
        $section->addHeader()->addImage(public_path('assets/img/kop.png'), ['width' => 610]);
        $section->addFooter()->addImage(public_path('assets/img/footer.png'), ['width' => 610]);

        $section->addText('Pasal 7 - PENUTUP', ['bold' => true], ['align' => 'center']);
        $section->addText('Hal-hal yang belum diatur akan ditetapkan kemudian dan menjadi bagian dari perjanjian ini.');
        $section->addText('Kerjasama hanya untuk kepentingan PKL dan tidak disalahgunakan.');
        $section->addText('Demikian kontrak kerjasama ini dibuat untuk dilaksanakan dengan penuh tanggung jawab.');
        $section->addTextBreak(3);

        $table = $section->addTable();
        $table->addRow();
        $cell1 = $table->addCell(4500);
        $cell2 = $table->addCell(4500);
        $cell1->addText("PIHAK PERTAMA", ['bold' => true], ['align' => 'center']);
        $cell1->addText("Kepala SMK-IT As-Syifa Boarding School", null, ['align' => 'center']);
        $cell1->addTextBreak(3);
        $cell1->addText("H. Agus Nur Purwanto, S.T.", ['bold' => true], ['align' => 'center']);
        $cell1->addText("NIP. ............................", null, ['align' => 'center']);

        $cell2->addText("Subang, 01 Januari 2026", null, ['align' => 'center']);
        $cell2->addText("PIHAK KEDUA", ['bold' => true], ['align' => 'center']);
        $cell2->addText("Pimpinan " . strtoupper($perusahaan), null, ['align' => 'center']);
        $cell2->addTextBreak(3);
        $cell2->addText("(...........................................)", ['bold' => true], ['align' => 'center']);
        $cell2->addText("(Nama dan Jabatan)", null, ['align' => 'center']);

        // === DOWNLOAD ===
        $filename = 'Surat_Perjanjian_PKL_' . $siswa->nama . '.docx';
        $tempFile = tempnam(sys_get_temp_dir(), 'word');
        $phpWord->save($tempFile, 'Word2007');

        return response()->download($tempFile, $filename)->deleteFileAfterSend(true);
    }
}
