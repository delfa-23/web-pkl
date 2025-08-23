<!DOCTYPE html>
<html>
<head>
    <title>Detail Tempat PKL Siswa</title>
</head>
<body>
    <h1>Detail Tempat PKL - {{ $siswa->nama_siswa }}</h1>

    @if($siswa->tempatPKL)
        <p><b>Nama Siswa:</b> {{ $siswa->tempatPKL->nama_siswa }}</p>
        <p><b>Kelas:</b> {{ $siswa->tempatPKL->kelas }}</p>
        <p><b>Program Keahlian:</b> {{ $siswa->tempatPKL->program_keahlian }}</p>
        <p><b>Tempat PKL:</b> {{ $siswa->tempatPKL->tempat_pkl }}</p>
        <p><b>Status:</b> {{ $siswa->tempatPKL->status }}</p>
    @else
        <p>Belum ada data tempat PKL untuk siswa ini.</p>
    @endif

    <a href="{{ route('guru.dashboard') }}">⬅ Kembali ke Dashboard</a>
</body>
</html>
