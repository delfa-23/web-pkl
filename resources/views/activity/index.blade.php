<h2>Daily Activity</h2>
<a href="{{ route('siswa.activity.create') }}">+ Tambah Aktivitas</a>

<table border="1" cellpadding="5">
    <tr>
        <th>Tanggal & Waktu</th>
        <th>Kegiatan</th>
        <th>Aksi</th>
    </tr>
    @foreach ($activities as $a)
    <tr>
        <td>{{ date('d-m-Y H:i', strtotime($a->tanggal)) }}</td>
        <td>{{ $a->kegiatan }}</td>
        <td>
            <a href="{{ route('siswa.activity.edit', $a->id) }}">Edit</a> |
            <form action="{{ route('siswa.activity.destroy', $a->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Yakin hapus?')">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

<br>
<a href="{{ route('siswa.dashboard') }}">Back</a>
