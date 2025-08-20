<h1>Selamat Datang, {{ $guru->nama }}!</h1>

<h3>Filter Siswa</h3>
<form method="GET" action="{{ route('guru.dashboard') }}">
    <input type="text" name="nama" placeholder="Cari nama siswa" value="{{ request('nama') }}">
    <select name="jurusan">
        <option value="">Semua Jurusan</option>
        <option value="RPL" {{ request('jurusan')=='RPL' ? 'selected' : '' }}>RPL</option>
        <option value="DKV" {{ request('jurusan')=='DKV' ? 'selected' : '' }}>DKV</option>
        <!-- Tambahkan jurusan lain sesuai db -->
    </select>
    <button type="submit">Filter</button>
</form>

<h2>Daftar Siswa</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>Nama</th>
        <th>Jurusan</th>
        <th>Aksi</th>
    </tr>
    @foreach($semuaSiswa as $s)
    <tr>
        <td>{{ $s->nama }}</td>
        <td>{{ $s->jurusan }}</td>
        <td>
            <a href="{{ route('guru.siswa.tempat', $s->id) }}">Lihat Tempat PKL</a> |
            <a href="{{ route('guru.siswa.activity', $s->id) }}">Lihat Daily Activity</a>
        </td>
    </tr>

    @endforeach
</table>
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>
