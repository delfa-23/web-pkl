<h2>Data Guru</h2>
<a href="{{ route('admin.guru.create') }}">+ Tambah Guru</a>
<table border="1" cellpadding="5">
    <tr>
        <th>ID Login</th>
        <th>Nama</th>
        <th>Mapel</th>
        <th>Aksi</th>
    </tr>
    @foreach ($guru as $g)
    <tr>
        <td>{{ $g->login->id_login }}</td>
        <td>{{ $g->nama }}</td>
        <td>{{ $g->mapel }}</td>
        <td>
            <a href="{{ route('admin.guru.edit', $g->id) }}">Edit</a> |
            <form action="{{ route('admin.guru.destroy', $g->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Yakin?')">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
<a href="{{ route('admin.dashboard') }}">Back</a>
