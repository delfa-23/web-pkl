<!DOCTYPE html>
<html>
<head>
    <title>Tambah Siswa</title>
</head>
<body>
    <h1>Tambah Siswa</h1>

    <form action="{{ route('admin.siswa.store') }}" method="POST">
        @csrf

        <label>ID Login:</label><br>
        <input type="text" name="id_login" placeholder="ID Login" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" placeholder="Password" required><br><br>

        <label>Nama:</label><br>
        <input type="text" name="nama" placeholder="Nama Siswa" required><br><br>

        <label>Kelas:</label><br>
        <input type="text" name="kelas" placeholder="Contoh: XI-RPL" required><br><br>

        <label>Jurusan:</label><br>
        <input type="text" name="jurusan" placeholder="Contoh: RPL" required><br><br>

        <button type="submit">Simpan</button>
    </form>

    <br>
    <a href="{{ route('admin.siswa.index') }}">Kembali</a>
</body>
</html>
