<!DOCTYPE html>
<html>
<head>
    <title>Edit Tempat PKL</title>
</head>
<body>
    <h1>Edit Tempat PKL</h1>

    <form method="POST" action="{{ route('siswa.tempat.update', $tempat->id) }}">
        @csrf
        @method('PUT')

        <label>Nama:</label>
        <input type="text" name="nama" value="{{ $tempat->nama }}" required><br>

        <label>Jurusan:</label>
        <input type="text" name="jurusan" value="{{ $tempat->jurusan }}" required><br>

        <label>Nama Perusahaan:</label>
        <input type="text" name="nama_perusahaan" value="{{ $tempat->nama_perusahaan }}" required><br>

        <label>Tempat PKL:</label>
        <input type="text" name="tempat_pkl" value="{{ $tempat->tempat_pkl }}" required><br>

        <button type="submit">Update</button>
    </form>

    <a href="{{ route('siswa.tempat.index') }}">Kembali</a>
</body>
</html>
