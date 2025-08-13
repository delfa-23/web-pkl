<!DOCTYPE html>
<html>
<head>
    <title>Data Siswa</title>
</head>
<body>
    <h1>Data Siswa</h1>

    <a href="{{ route('admin.siswa.create') }}">Tambah Siswa</a>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Jurusan</th>
                <th>ID Login</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($siswas as $siswa)
                <tr>
                    <td>{{ $siswa->nama }}</td>
                    <td>{{ $siswa->kelas }}</td>
                    <td>{{ $siswa->jurusan }}</td>
                    <td>{{ $siswa->login->id_login }}</td>
                    <td>
                        <a href="{{ route('admin.siswa.edit', $siswa->id) }}">Edit</a> |
                        <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin mau hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('admin.dashboard')}}">back</a>
</body>
</html>
