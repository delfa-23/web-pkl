<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Surat Pengajuan Tempat PKL</title>
  <style>
    body {
      font-family: "Times New Roman", serif;
      font-size: 12pt;
      line-height: 1.5;
      margin: 0;
      padding: 0;
    }

    .page {
      width: 210mm;   /* A4 lebar */
      min-height: 297mm; /* A4 tinggi */
      padding: 2.5cm 3cm; /* margin dalam kertas */
      margin: auto;
      background: white;
    }

    .center { text-align: center; font-weight: bold; }
    .right { text-align: right; }
    .indent { text-indent: 40px; text-align: justify; }
    .kop img { width: 100%; height: auto; }
    .footer img { width: 100%; height: auto; margin-top: 20px; }
  </style>
</head>
<body>
  <div class="page">

    <!-- Kop -->
    <div class="kop">
      <img src="{{ asset('storage/assets/img/kop.png') }}" alt="Kop Surat">
    </div>

    <!-- Judul -->
    <h3 class="center">SURAT PENGAJUAN TEMPAT PKL</h3>

    <div class="right">
      <p>Subang, {{ now()->translatedFormat('d F Y') }}</p>
    </div>

    <p>Nomor : ............</p>
    <p>Lamp. : -</p>
    <p>Perihal : Pengajuan Tempat PKL</p>
    <br>

    <p>Kepada Yth,</p>
    <p>Bapak/Ibu Pimpinan DUDI ...........................</p>
    <p>Di tempat</p>
    <br>

    <p>Dengan hormat,</p>
    <p class="indent">
      Sesuai dengan Permendikbud No. 50 Tahun 2020 Tentang Praktik Kerja Lapangan (PKL) bagi peserta didik,
      bahwa proses pembelajaran di SMK harus melibatkan Dunia Industri dalam pembimbingan PKL.
    </p>

    <p>Saya yang bertandatangan di bawah ini :</p>
    <p style="margin-left:50px;">Nama : {{ $siswa->nama ?? '...................' }}</p>
    <p style="margin-left:50px;">NIS : {{ $siswa->nis ?? '...................' }}</p>
    <p style="margin-left:50px;">Jurusan : {{ $siswa->jurusan ?? '...................' }}</p>
    <p style="margin-left:50px;">Kelas : {{ $siswa->kelas ?? '...................' }}</p>

    <p class="indent">
      Dengan ini bermaksud mengajukan permohonan Praktik Kerja Lapangan di Perusahaan/instansi/industri yang Bapak/Ibu pimpin.
    </p>

    <p class="indent">
      Demikian surat ini disampaikan, besar harapan agar kami dapat diterima di perusahaan yang Bapak/Ibu pimpin.
    </p>

    <!-- Footer -->
    <div class="footer">
      <img src="{{ asset('storage/assets/img/footer.png') }}" alt="Footer Surat">
    </div>
  </div>
</body>
</html>
