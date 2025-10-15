@php
    $kop = base64_encode(file_get_contents(public_path('assets/img/kop.png')));
    $footer = base64_encode(file_get_contents(public_path('assets/img/footer.png')));
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Perjanjian Kerjasama PKL</title>
    <style>
        @page {
            margin: 0cm;
        }

        body {
            font-family: "Times New Roman", serif;
            margin: 3.5cm 2.5cm 3cm 2.5cm;
            /* area teks */
            line-height: 1.4;
            text-align: justify;
        }

        /* ==== KOP & FOOTER ==== */
        .kop,
        .footer {
            position: fixed;
            left: 0;
            right: 0;
            width: 100%;
            z-index: -1;
        }

        .kop {
            top: 0;
            /* benar-benar nempel ke atas kertas */
        }

        .footer {
            bottom: 0;
            /* benar-benar nempel ke bawah kertas */
        }

        .kop img,
        .footer img {
            width: 100%;
            height: auto;
            display: block;
        }

        /* ==== KONTEN ==== */
        .content {
            margin-top: 180px;
            /* jarak dari kop biar teks gak nabrak */
            margin-bottom: 150px;
            /* jarak dari footer */
        }

        h3 {
            text-align: center;
            font-weight: bold;
            margin: 30px 0 10px 0;
        }

        .judul {
            text-align: center;
            text-transform: uppercase;
            font-weight: bold;
            margin-top: 60px;
            line-height: 1.5;
        }

        .nomor {
            text-align: center;
            margin-top: 5px;
            margin-bottom: 25px;
        }

        p,
        ul {
            font-size: 12pt;
            margin: 0 0 8px 0;
        }

        ul {
            margin-left: 25px;
        }

        .signature {
            width: 100%;
            margin-top: 60px;
            font-size: 12pt;
        }

        .left {
            float: left;
            width: 45%;
            text-align: center;
        }

        .right {
            float: right;
            width: 45%;
            text-align: center;
        }
    </style>
</head>

<body>

    <!-- kop -->
    <div class="kop">
        <img src="data:image/png;base64,{{ $kop }}" alt="Kop Surat">
    </div>

    <!-- footer -->
    <div class="footer">
        <img src="data:image/png;base64,{{ $footer }}" alt="Footer Surat">
    </div>

    <!-- ================= HALAMAN 1 ================= -->
    <div class="judul">
        <p>PERJANJIAN KERJASAMA</p>
        <p>ANTARA</p>
        <p>SMK-IT AS-SYIFA BOARDING SCHOOL DENGAN</p>
        <p>(NAMA DUDI)</p>
        <p>TENTANG</p>
        <p>PENYELENGGARAAN PRAKTEK KERJA LAPANGAN</p>
    </div>

    <div class="nomor">
        <p><b>No.</b> ....................................................</p>
        <p><b>No. (dari DUDI)</b> ....................................................</p>
    </div>

    <p><b>Yang bertanda tangan di bawah ini :</b></p>

    <table>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>H. Agus Nur Purwanto, S.T.</td>
        </tr>
        <tr>
            <td>NIP</td>
            <td>:</td>
            <td>................................................</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>Kepala SMK-IT As-Syifa Boarding School</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>Kp. Kumpay RT/RW 06/02 Desa Kumpay, Kec. Jalancagak, Kab. Subang</td>
        </tr>
    </table>

    <p>Selanjutnya dalam kesepakatan ini disebut sebagai <b>PIHAK PERTAMA</b>.</p>

    <table>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>................................................</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>................................................</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>................................................</td>
        </tr>
        <tr>
            <td>Telepon</td>
            <td>:</td>
            <td>................................................</td>
        </tr>
    </table>

    <p>Selanjutnya dalam kesepakatan ini disebut sebagai <b>PIHAK KEDUA</b>.</p>

    <p>Kedua belah pihak sepakat untuk mengadakan kerjasama dalam rangka meningkatkan mutu pendidikan Sekolah Menengah
        Kejuruan khususnya Konsentrasi Keahlian Desain Komunikasi Visual/Rekayasa Perangkat Lunak dengan
        menyelenggarakan <b>PRAKTEK KERJA LAPANGAN (PKL)</b> sebagaimana dituangkan dalam pasal-pasal berikut ini:</p>

    <div style="page-break-before: always;"></div>

    <!-- ================= HALAMAN 2 ================= -->
    <h3>Pasal 1<br>TUJUAN</h3>
    <p>Kerjasama ini bertujuan untuk meningkatkan mutu sumber daya manusia Indonesia melalui peningkatan kualitas mutu
        pendidikan pada Sekolah Menengah Kejuruan sesuai dengan tuntutan kebutuhan Dunia Usaha dan Dunia Industri serta
        perkembangan ilmu pengetahuan dan teknologi.</p>

    <h3>Pasal 2<br>LINGKUP KERJASAMA</h3>
    <p><b>PIHAK PERTAMA:</b></p>
    <ul>
        <li>Menyiapkan siswa untuk melaksanakan Praktek Kerja Lapangan (PKL) dengan jumlah dan perencanaan yang
            disetujui oleh Pihak Kedua.</li>
        <li>Menyiapkan dokumen administrasi Praktek Kerja (PKL).</li>
        <li>Mengkoordinasikan pelaksanaan Praktek Kerja Lapangan (PKL).</li>
        <li>Memantau dan melakukan evaluasi pelaksanaan Praktek Kerja Lapangan.</li>
    </ul>

    <p><b>PIHAK KEDUA:</b></p>
    <ul>
        <li>Memberikan kesempatan kepada siswa untuk Praktek Kerja Lapangan.</li>
        <li>Menyiapkan tenaga pembimbing yang akan terlibat dalam pelaksanaan Praktek Kerja Lapangan (PKL).</li>
        <li>Menyiapkan sarana dan prasarana Praktek Kerja.</li>
        <li>Memberikan bimbingan dan pelatihan kepada siswa sesuai Program Praktek Kerja Lapangan (PKL).</li>
        <li>Menandatangani buku jurnal Praktek Kerja Lapangan (PKL).</li>
        <li>Menandatangani sertifikat sebagai bukti siswa sudah melaksanakan Praktek Kerja Lapangan (PKL).</li>
        <li>Menjamin keamanan, kesehatan, dan keselamatan kerja peserta PKL apabila harus ditugaskan pada shift malam.
        </li>
    </ul>

    <h3>Pasal 3<br>PELAKSANAAN</h3>
    <p>Kegiatan PKL dilakukan selama 6 (enam) bulan yang dimulai dari 1 Januari s.d 30 Juni 2026.</p>
    <p>Penugasan kerja di tempat PKL agar menyesuaikan kompetensi siswa PKL.</p>

    <div style="page-break-before: always"></div>

    <h3>Pasal 4<br>DASAR HUKUM</h3>
    <ul>
        <li>Undang-undang No. 20 Tahun 2003 tentang Sistem Pendidikan Nasional.</li>
        <li>Peraturan Menteri Pendidikan dan Kebudayaan Republik Indonesia Nomor 50 Tahun 2020 tentang Praktik Kerja
            Lapangan bagi Peserta Didik.</li>
        <li>Panduan PKL sebagai mata pelajaran implementasi Kurikulum Merdeka Edisi Revisi 2023.</li>
    </ul>

    <h3>Pasal 5<br>JANGKA WAKTU KERJASAMA</h3>
    <p>Naskah kerjasama ini berlaku selama 4 (empat) tahun terhitung sejak ditandatangani dan dapat diperpanjang sesuai
        kesepakatan kedua belah pihak.</p>

    <h3>Pasal 6<br>LAIN-LAIN</h3>
    <p>Apabila dalam pelaksanaan kerjasama ini timbul masalah atau perselisihan maka kedua belah pihak sepakat untuk
        menyelesaikannya secara musyawarah.</p>

    <div style="page-break-before: always"></div>
    <h3>Pasal 7<br>PENUTUP</h3>
    <p>Hal-hal lain yang belum tertuang dalam naskah kerjasama ini akan diatur dan ditetapkan kemudian oleh kedua belah
        pihak dan merupakan bagian yang tidak terpisahkan dari naskah perjanjian kerjasama ini.</p>
    <p>Kerjasama ini hanya digunakan untuk kepentingan Praktek Kerja Lapangan (PKL) dan tidak akan disalahgunakan untuk
        kepentingan pribadi atau lembaga.</p>
    <p>Demikian kontrak kerjasama ini dibuat untuk dilaksanakan dengan penuh tanggung jawab demi kepentingan dan
        kemajuan sumber daya manusia.</p>

    <div class="signature">
        <div class="left">
            <p>
                PIHAK PERTAMA<br>
                Kepala SMK-IT As-SYIFA Boarding School<br><br><br><br>
                <b>H. Agus Nur Purwanto, S.T.</b><br>
                NIP. ................................................
            </p>
        </div>

        <div class="right">
            <p>
                Subang, 01 Januari 2026<br><br>
                PIHAK KEDUA<br>
                Pimpinan DUDI<br><br><br><br>
                <b>................................................</b><br>
                (Nama dan Jabatan)
            </p>
        </div>
    </div>


</body>

</html>
