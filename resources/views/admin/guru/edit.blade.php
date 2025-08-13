<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Guru</title>
</head>
<body>
    <h2>Edit Data Guru</h2>
    <form action="{{ route('admin.guru.update', $guru->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nama Guru:</label><br>
        <input type="text" name="nama" value="{{ $guru->nama }}" required><br><br>

        <label>ID Login:</label><br>
        <input type="text" name="id_login" value="{{ $guru->login->id_login }}" required><br><br>

        <label>Mapel:</label><br>
        <input type="text" name="mapel" value="{{ $guru->mapel }}" required><br><br>

        <label>Password (kosongkan jika tidak diubah):</label><br>
        <input type="password" name="password"><br><br>

        <button type="submit">Update</button>
        <a href="{{ route('admin.guru.index') }}">Batal</a>
    </form>
</body>
</html>
