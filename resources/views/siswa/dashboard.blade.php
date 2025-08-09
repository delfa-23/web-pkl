<!DOCTYPE html>
<html>
<head>
    <title>Siswa Dashboard</title>
</head>
<body>
    <h1>Selamat Datang, Siswa!</h1>
    <p>Ini adalah halaman dashboard khusus siswa.</p>

    <h3>Menu:</h3>
    <ul>
        <li><a href="#">Lihat Jadwal PKL</a></li>
        <li><a href="#">Isi Laporan Harian</a></li>
        <li><a href="#">Lihat Nilai PKL</a></li>
    </ul>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
