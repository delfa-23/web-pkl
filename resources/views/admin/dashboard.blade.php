<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Selamat Datang, Admin!</h1>
    <p>Ini adalah halaman dashboard khusus admin.</p>

    <h3>Menu:</h3>
    <ul>
        <li><a href="/admin/user/create">Tambah User Baru</a></li>
        <li><a href="#">Kelola Data Siswa</a></li>
        <li><a href="#">Kelola Data Guru</a></li>
        <li><a href="#">Kelola Data PKL</a></li>
    </ul>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
