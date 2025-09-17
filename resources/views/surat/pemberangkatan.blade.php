<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Surat Pemberangkatan PKL</title>
  <style>
    body { font-family: "Times New Roman", serif; margin: 40px; line-height: 1.6; }
    h2 { text-align: center; text-decoration: underline; margin-bottom: 20px; }
    .content { margin-top: 20px; }
    .footer { margin-top: 60px; text-align: right; }
  </style>
</head>
<body>
  <h2>SURAT PEMBERANGKATAN PKL</h2>

  <p>Kepada Yth,<br>
  Pimpinan {{ $siswa->tempats->first()->nama_perusahaan ?? '________________' }}<br>
  di Tempat</p>

  <div class="content">
    <p>Dengan hormat,</p>
    <p>Melalui surat ini, kami memberangkatkan siswa berikut untuk melaksanakan Praktik Kerja Lapangan (PKL):</p>

    <table style="margin: 10px 0;">
      <tr>
        <td>Nama</td>
        <td>:</td>
        <td>{{ $siswa->nama }}</td>
      </tr>
      <tr>
        <td>Kelas / Jurusan</td>
        <td>:</td>
        <td>{{ $siswa->kelas }} / {{ $siswa->jurusan }}</td>
      </tr>
      <tr>
        <td>Tempat PKL</td>
        <td>:</td>
        <td>{{ $siswa->tempats->first()->nama_perusahaan ?? '-' }}</td>
      </tr>
      <tr>
        <td>Alamat</td>
        <td>:</td>
        <td>{{ $siswa->tempats->first()->alamat_perusahaan ?? '-' }}</td>
      </tr>
    </table>

    <p>Demikian surat ini kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terima kasih.</p>
  </div>

  <div class="footer">
    <p>Subang, ................ 2025<br>
    Kepala Sekolah</p>
    <br><br><br>
    <p>( ______________________ )</p>
  </div>
</body>
</html>
