<!DOCTYPE html>
<html>
<head>
    <title>Surat Izin Orang Tua/Wali</title>
    <style>
        body { font-family: Times New Roman, serif; line-height: 1.5; }
        .center { text-align: center; }
        .right { text-align: right; }
        .indent { margin-left: 40px; }
    </style>
</head>
<body>

    <h3 class="center"><u>SURAT IZIN ORANG TUA/WALI</u></h3>
    <br>

    <p>Yang bertanda tangan di bawah ini:</p>
    <p>Nama Orang Tua/Wali : .........................................................</p>
    <p>Alamat : ..............................................................................................</p>
    <p>No. HP : ..............................................................................................</p>

    <p>adalah orang tua/wali dari:</p>
    <p>Nama Siswa : {{ $siswa->nama ?? '..................................' }}</p>
    <p>NIS : {{ $siswa->nis ?? '..................................' }}</p>
    <p>Kelas : {{ $siswa->kelas ?? '..................................' }}</p>
    <p>Jurusan : {{ $siswa->jurusan ?? '..................................' }}</p>

    <p>
        Dengan ini memberikan izin kepada putra/putri kami untuk mengikuti
        <b>Praktik Kerja Lapangan (PKL)</b> yang diselenggarakan oleh
        SMK-IT As-Syifa Boarding School pada:
    </p>

    @if($siswa->tempatAktif())
    <p>Tempat PKL : {{ $siswa->tempatAktif()->nama_perusahaan ?? '..................................' }}</p>
    <p>Alamat Perusahaan : {{ $siswa->tempatAktif()->alamat_perusahaan ?? '..................................' }}</p>
    @endif
    <p>Waktu Pelaksanaan : .......................... s/d ..........................</p>

    <p>
        Saya selaku orang tua/wali memahami bahwa kegiatan PKL ini merupakan bagian dari program pendidikan sekolah,
        serta menyetujui putra/putri kami untuk mengikuti kegiatan tersebut dengan penuh tanggung jawab.
    </p>

    <p>
        Demikian surat izin ini dibuat dengan sebenarnya, untuk digunakan sebagaimana mestinya.
    </p>

    <div class="right">
        <p>.................................., ................. 2025</p>
        <p>Orang Tua/Wali,</p>
        <br><br><br>
        <p>(.............................................)</p>
    </div>

</body>
</html>
