<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Surat Keterangan PKL</title>
  <style>
    body { font-family: "Times New Roman", serif; margin: 40px; line-height: 1.6; }
    h2 { text-align: center; text-decoration: underline; margin-bottom: 20px; }
    .content { margin-top: 20px; }
    .footer { margin-top: 60px; text-align: right; }
  </style>
</head>
<body>
  <h2>SURAT KETERANGAN PKL</h2>

  <p>Yang bertanda tangan di bawah ini menerangkan bahwa:</p>

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
  </table>

  <div class="content">
    <p>Adalah benar siswa SMK As-Syifa yang sedang mengikuti kegiatan Praktik Kerja Lapangan (PKL) di:</p>

    <p>
      {{ $siswa->tempats->first()->nama_perusahaan ?? '________________' }}<br>
      {{ $siswa->tempats->first()->alamat_perusahaan ?? '________________' }}
    </p>

    <p>Surat keterangan ini dibuat untuk digunakan sebagaimana mestinya.</p>
  </div>

  <div class="footer">
    <p>Subang, ................ 2025<br>
    Kepala Sekolah</p>
    <br><br><br>
    <p>( ______________________ )</p>
  </div>
</body>
</html>
