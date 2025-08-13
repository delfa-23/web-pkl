<!DOCTYPE html>
<html>
<head>
    <title>Edit Siswa</title>
</head>
<body>
    <h1>Edit Siswa</h1>

    <form action="{{ route('admin.siswa.update', $siswa->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>ID Login:</label><br>
        <input type="text" name="id_login" value="{{ $siswa->login->id_login }}" required><br><br>

        <label>Password (Kosongkan jika tidak ingin diubah):</label><br>
        <input type="password" name="password" placeholder="Password baru"><br><br>

        <label>Nama:</label><br>
        <input type="text" name="nama" value="{{ $siswa->nama }}" required><br><br>

        <label>Kelas:</label><br>
        <input type="text" name="kelas" value="{{ $siswa->kelas }}" required><br><br>

        <label>Jurusan:</label><br>
        <input type="text" name="jurusan" value="{{ $siswa->jurusan }}" required><br><br>

        <button type="submit">Update</button>
    </form>

    <br>
    <a href="{{ route('admin.siswa.index') }}">Kembali</a>
</body>
</html>
