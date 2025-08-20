<!DOCTYPE html>
<html>
<head>
    <title>Siswa Dashboard</title>
</head>
<body>
    <h1>Selamat Datang, {{ $siswa->nama }}!</h1>

    <h3>Menu:</h3>
    <ul>
        <li><a href="{{ route('siswa.tempat.index') }}">Tempat PKL</a></li>
        <li><a href="{{ route('siswa.activity.index') }}">Daily Activity</a></li>
    </ul>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
