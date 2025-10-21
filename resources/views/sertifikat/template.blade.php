<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Sertifikat PKL {{ $siswa->nama }}</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      width: 297mm;
      height: 210mm;
      background: url('{{ public_path('assets/img/sertifikat-bg.png') }}') no-repeat center center;
      background-size: cover;
      font-family: 'Times New Roman', serif;
    }
    .content {
      position: absolute;
      top: 48%;
      left: 50%;
      transform: translate(-50%, -50%);
      text-align: center;
      color: #333;
    }
    .nama {
      font-size: 28pt;
      font-weight: bold;
      color: #007A7A;
      margin-bottom: 8px;
    }
    .text {
      font-size: 14pt;
    }
  </style>
</head>
<body>
  <div class="content">
    <div class="nama">{{ strtoupper($siswa->nama) }}</div>
    <div class="text">
      Telah menyelesaikan Praktik Kerja Lapangan (PKL) di <b>{{ $tempat->nama_perusahaan ?? '................................' }}</b><br>
      Beralamat di {{ $tempat->alamat_perusahaan ?? '................................' }}<br><br>
      <i>Selama periode ................................ s/d ................................</i>
    </div>
  </div>
</body>
</html>
