<!DOCTYPE html>
<html>
<head>
    <title>Guru Dashboard</title>
</head>
<body>
    <h1>Selamat Datang, Guru!</h1>
    <p>Ini adalah halaman dashboard khusus guru.</p>

    <h3>Menu:</h3>
    <ul>
        <li><a href="#">Lihat Data Siswa PKL</a></li>
        <li><a href="#">Lihat Laporan Harian</a></li>
        <li><a href="#">Kelola Nilai PKL</a></li>
    </ul>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
