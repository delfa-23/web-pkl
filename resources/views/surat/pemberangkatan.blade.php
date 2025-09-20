<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Surat Pengantar Keberangkatan PKL</title>
  <style>
    body { font-family: "Times New Roman", serif; margin: 40px; line-height: 1.6; }
    h2 { text-align: center; text-decoration: underline; margin-bottom: 5px; }
    .nomor { text-align: center; margin-bottom: 20px; }
    .content { margin-top: 20px; }
    table td { padding: 3px 8px; vertical-align: top; }
    .footer { margin-top: 60px; text-align: center; }
  </style>
</head>
<body>
  <h2>SURAT PENGANTAR KEBERANGKATAN</h2>
  <p class="nomor">Nomor: ....../SMK-IT/AS-SYIFA/............/20....</p>

  <p>Yang bertanda tangan di bawah ini:</p>
  <table>
    <tr>
      <td>Nama</td>
      <td>:</td>
      <td>..............................................................................</td>
    </tr>
    <tr>
      <td>Jabatan</td>
      <td>:</td>
      <td>............................................................................</td>
    </tr>
    <tr>
      <td>Sekolah</td>
      <td>:</td>
      <td>SMK-IT As-Syifa Boarding School</td>
    </tr>
  </table>

  <p>Dengan ini menerangkan bahwa:</p>
  <table>
    <tr>
      <td>Nama Siswa</td>
      <td>:</td>
      <td>{{ $siswa->nama }}</td>
    </tr>
    <tr>
      <td>NIS</td>
      <td>:</td>
      <td>{{ $siswa->nis ?? '................................' }}</td>
    </tr>
    <tr>
      <td>Kelas</td>
      <td>:</td>
      <td>{{ $siswa->kelas }}</td>
    </tr>
    <tr>
      <td>Jurusan</td>
      <td>:</td>
      <td>{{ $siswa->jurusan }}</td>
    </tr>
  </table>

  <p>
    adalah benar siswa SMK-IT As-Syifa Boarding School yang akan melaksanakan Praktik Kerja Lapangan (PKL) di:
  </p>

  <table>
    <tr>
      <td>Tempat PKL</td>
      <td>:</td>
      <td>{{ $siswa->tempats->first()->nama_perusahaan ?? '................................' }}</td>
    </tr>
    <tr>
      <td>Alamat Perusahaan</td>
      <td>:</td>
      <td>{{ $siswa->tempats->first()->alamat_perusahaan ?? '................................' }}</td>
    </tr>
    <tr>
      <td>Waktu PKL</td>
      <td>:</td>
      <td>.................................. s/d ..................................</td>
    </tr>
  </table>

  <p>
    Sehubungan dengan itu, kami mohon kepada pihak perusahaan/instansi agar dapat menerima siswa tersebut untuk melaksanakan PKL sesuai ketentuan yang berlaku.
  </p>
  <p>
    Demikian surat pengantar ini dibuat untuk dipergunakan sebagaimana mestinya. Atas perhatian dan kerja samanya, kami ucapkan terima kasih.
  </p>
  <p>Wassalamu’alaikum Wr. Wb.</p>

  <div class="footer">
    <p>.................................., ................. 2026</p>
    <p>Kepala Sekolah<br>SMK-IT As-Syifa Boarding School</p>
    <br><br><br>
    <p><b>H. Agus Nur Purwanto, S.T.</b><br>
    NIP. ........................................</p>
  </div>
</body>
</html>
