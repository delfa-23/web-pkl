<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Pengajuan Tempat PKL</title>
    <style>
        @page { margin: 0cm; }
        body {
            font-family: "Times New Roman", serif;
            font-size: 10.5pt;
            line-height: 1.25;
            margin: 0;
            padding: 0;
        }
        .kop img, .footer img {
            width: 100%;
            height: auto;
            display: block;
        }
        .kop {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
        }
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
        }
        .content {
            margin: 115px 65px 95px 65px; /* pas banget 1 halaman */
            text-align: justify;
        }
        .center { text-align: center; font-weight: bold; }
        .right { text-align: right; }
        .indent { text-indent: 40px; }
        .ttd { text-align: center; margin-top: 35px; }
    </style>
</head>
<body>
    @php
        $kop = base64_encode(file_get_contents(public_path('assets/img/kop.png')));
        $footer = base64_encode(file_get_contents(public_path('assets/img/footer.png')));
    @endphp

    <div class="kop">
        <img src="data:image/png;base64,{{ $kop }}">
    </div>

    <div class="footer">
        <img src="data:image/png;base64,{{ $footer }}">
    </div>

    <div class="content">
        <h3 class="center">SURAT PENGAJUAN TEMPAT PKL</h3>

        <div class="right">
            <p>Subang, {{ now()->translatedFormat('d F Y') }}</p>
        </div>

        <p>Nomor : ............</p>
        <p>Lamp. : -</p>
        <p>Perihal : Pengajuan Tempat PKL</p>
        <br>

        <p>Kepada Yth,</p>
        <p>Bapak/Ibu Pimpinan DUDI {{ $perusahaan->nama ?? '...................' }}</p>
        <p>Di tempat</p>
        <br>

        <p>Dengan hormat,</p>
        <p class="indent">
            Sesuai dengan Permendikbud No. 50 Tahun 2020 tentang Praktik Kerja Lapangan (PKL)
            bagi peserta didik, bahwa proses pembelajaran di SMK harus melibatkan Dunia Industri
            dalam pembimbingan PKL.
        </p>

        <p>Saya yang bertandatangan di bawah ini:</p>
        <p style="margin-left:50px;">Nama : {{ $siswa->nama ?? '...................' }}</p>
        <p style="margin-left:50px;">NIS : {{ $siswa->nis ?? '...................' }}</p>
        <p style="margin-left:50px;">Jurusan : {{ $siswa->jurusan ?? '...................' }}</p>
        <p style="margin-left:50px;">Kelas : {{ $siswa->kelas ?? '...................' }}</p>

        <p class="indent">
            Dengan ini bermaksud mengajukan permohonan Praktik Kerja Lapangan di
            perusahaan/instansi/industri yang Bapak/Ibu pimpin.
        </p>

        <p class="indent">
            Demikian surat ini disampaikan. Besar harapan agar kami dapat diterima di tempat
            Bapak/Ibu pimpin.
        </p>

        <div class="ttd">
            <p>Mengetahui,</p>
            <p>Kepala SMK-IT As-Syifa Boarding School,</p>
            <br><br><br>
            <p><strong>H. AGUS NUR PURWANTO, S.T.</strong></p>
            <p>NIY. ...................................</p>
        </div>
    </div>
</body>
</html>
