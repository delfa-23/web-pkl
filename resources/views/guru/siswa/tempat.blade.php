<!DOCTYPE html>
<html>
<head>
    <title>Tempat PKL Siswa</title>
</head>
<body>
    <h1>Tempat PKL - {{ $siswa->nama }}</h1>

    @if($siswa->tempatPKL)
        <p><b>Nama:</b> {{ $siswa->tempatPKL->nama }}</p>
        <p><b>Jurusan:</b> {{ $siswa->tempatPKL->jurusan }}</p>
        <p><b>Perusahaan:</b> {{ $siswa->tempatPKL->nama_perusahaan }}</p>
        <p><b>Tempat PKL:</b> {{ $siswa->tempatPKL->tempat_pkl }}</p>
    @else
        <p>Belum ada data tempat PKL.</p>
    @endif

    <a href="{{ route('guru.dashboard') }}">Kembali ke Dashboard</a>
</body>
</html>
