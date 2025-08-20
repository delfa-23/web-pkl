<!DOCTYPE html>
<html>
<head>
    <title>Daily Activity Siswa</title>
</head>
<body>
    <h1>Daily Activity - {{ $siswa->nama }}</h1>

    @if($siswa->activities && $siswa->activities->count() > 0)
        <table border="1" cellpadding="5">
            <tr>
                <th>Tanggal & Waktu</th>
                <th>Kegiatan</th>
            </tr>
            @foreach($siswa->activities as $activity)
            <tr>
                <td>{{ $activity->tanggal }} {{ $activity->waktu }}</td>
                <td>{{ $activity->kegiatan }}</td>
            </tr>
            @endforeach
        </table>
    @else
        <p>Belum ada data daily activity.</p>
    @endif

    <a href="{{ route('guru.dashboard') }}">Kembali ke Dashboard</a>
</body>
</html>
