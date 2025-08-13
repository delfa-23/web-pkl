<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Guru</title>
</head>
<body>
    <h2>Tambah Data Guru</h2>
    <form action="{{ route('admin.guru.store') }}" method="POST">
        @csrf

        <label>Nama Guru:</label><br>
        <input type="text" name="nama" required><br><br>

        <label>Mata Pelajaran:</label><br>
        <input type="text" name="mapel" required><br><br>

        <label>ID Login:</label><br>
        <input type="text" name="id_login" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Simpan</button>
        <a href="{{ route('admin.guru.index') }}">Kembali</a>
    </form>
</body>
</html>
