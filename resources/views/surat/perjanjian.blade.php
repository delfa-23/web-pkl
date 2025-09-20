<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Perjanjian Kerjasama PKL</title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            margin: 40px;
            line-height: 1.6;
        }

        h2,
        h3 {
            text-align: center;
            margin: 5px 0;
        }

        .content {
            margin-top: 20px;
            text-align: justify;
        }

        .pasal {
            margin-top: 20px;
        }

        .ttd {
            display: flex;
            justify-content: space-around;
            align-items: flex-start;
            margin-top: 30px;
        }

        .ttd>div {
            flex: 1;
            text-align: center;
            margin: 0 10px;
        }

        .ttd p {
            margin: 3px 0;
            /* rapetin spasi antar baris */
        }
    </style>
</head>

<body>
    <h2>PERJANJIAN KERJASAMA</h2>
    <h3>ANTARA</h3>
    <h3>SMK-IT AS-SYIFA BOARDING SCHOOL DENGAN</h3>
    <h3>{{ $siswa->tempats->first()->nama_perusahaan ?? '(NAMA DUDI)' }}</h3>
    <h3>TENTANG</h3>
    <h3>PENYELENGGARAAN PRAKTEK KERJA LAPANGAN</h3>

    <p style="text-align:center;"><u>No.</u></p>
    <p style="text-align:center;">No. (dari DUDI) ................................</p>

    <div class="content">
        <p><b>Yang bertanda tangan di bawah ini :</b></p>

        <p>
            Nama : H. Agus Nur Purwanto, S.T.<br>
            NIP : ........................................<br>
            Jabatan : Kepala SMK-IT As-Syifa Boarding School<br>
            Alamat : KP. Kumpay RT/RW 06/02 Desa Kumpay, Kec. Jalancagak, Kab. Subang.
        </p>
        <p>Selanjutnya dalam kesepakatan ini disebut sebagai <b>PIHAK PERTAMA</b>.</p>

        <p>
            Nama : ........................................<br>
            Jabatan : ....................................<br>
            Alamat : .....................................<br>
            Telepon : ....................................
        </p>
        <p>Selanjutnya dalam kesepakatan ini disebut sebagai <b>PIHAK KEDUA</b>.</p>

        <p>
            Kedua belah pihak sepakat untuk mengadakan kerjasama dalam rangka meningkatkan mutu pendidikan
            Sekolah Menengah Kejuruan khususnya Konsentrasi Keahlian
            @if ($siswa->jurusan == 'RPL')
                Rekayasa Perangkat Lunak
            @elseif($siswa->jurusan == 'DKV')
                Desain Komunikasi Visual
            @else
                {{ $siswa->jurusan ?? '........................' }}
            @endif
            dengan menyelenggarakan PRAKTEK KERJA sebagaimana dituangkan dalam pasal-pasal berikut ini:
        </p>


        <div class="pasal">
            <h4>Pasal 1<br>TUJUAN</h4>
            <p>Kerjasama ini bertujuan untuk meningkatkan mutu sumber daya manusia Indonesia melalui peningkatan
                kualitas mutu pendidikan ...</p>
        </div>

        <div class="pasal">
            <h4>Pasal 2<br>LINGKUP KERJASAMA</h4>
            <p><b>PIHAK PERTAMA:</b></p>
            <ul>
                <li>Menyiapkan siswa untuk melaksanakan Praktek Kerja Lapangan (PKL) ...</li>
                <li>Menyiapkan dokumen administrasi Praktek Kerja ...</li>
            </ul>
            <p><b>PIHAK KEDUA:</b></p>
            <ul>
                <li>Memberikan kesempatan kepada siswa untuk PKL ...</li>
                <li>Menyiapkan tenaga pembimbing ...</li>
            </ul>
        </div>

        <div class="pasal">
            <h4>Pasal 3<br>PELAKSANAAN</h4>
            <p>Kegiatan PKL dilakukan selama 6 (enam) bulan dimulai dari 1 Januari s.d 30 Juni 2026 ...</p>
        </div>

        <div class="pasal">
            <h4>Pasal 4<br>DASAR HUKUM</h4>
            <p>Pelaksanaan kegiatan PKL mengacu pada UU No. 20 Tahun 2003, Permendikbud No. 50 Tahun 2020, serta Panduan
                PKL Kurikulum Merdeka Revisi 2023.</p>
        </div>

        <div class="pasal">
            <h4>Pasal 5<br>JANGKA WAKTU</h4>
            <p>Perjanjian ini berlaku selama 4 tahun sejak ditandatangani dan dapat diperpanjang sesuai kesepakatan.</p>
        </div>

        <div class="pasal">
            <h4>Pasal 6<br>LAIN-LAIN</h4>
            <p>Apabila timbul perselisihan, kedua belah pihak sepakat menyelesaikan secara musyawarah.</p>
        </div>

        <div class="pasal">
            <h4>Pasal 7<br>PENUTUP</h4>
            <p>Hal-hal lain yang belum tertuang akan diatur kemudian. Perjanjian ini hanya digunakan untuk kepentingan
                PKL.</p>
        </div>
    </div>

    <p style="text-align:right; margin-top:40px;">Subang, 01 Januari 2026</p>

    <table style="width:100%; margin-top:50px; text-align:center;">
  <tr>
    <td style="width:50%;">
      <p><b>PIHAK PERTAMA</b><br>
         Kepala SMK-IT As-Syifa Boarding School</p>
      <br><br><br>
      <p><b><u>H. Agus Nur Purwanto, S.T.</u></b><br>
         NIP. ....................................</p>
    </td>
    <td style="width:50%;">
      <p><b>PIHAK KEDUA</b><br>
         Pimpinan DUDI</p>
      <br><br><br>
      <p><b><u>....................................</u></b><br>
         ....................................</p>
    </td>
  </tr>
</table>

</body>

</html>
