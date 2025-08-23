<h2>Tempat PKL</h2>

@if($tempat->count() > 0)
    <table border="1" cellpadding="5">
        <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Program Keahlian</th>
            <th>Tempat PKL</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        @foreach($tempat as $i => $t)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $t->nama_siswa }}</td>
            <td>{{ $t->kelas }}</td>
            <td>{{ $t->program_keahlian }}</td>
            <td>{{ $t->tempat_pkl }}</td>
            <td>{{ $t->status }}</td>
            <td>
                <a href="{{ route('siswa.tempat.edit', $t->id) }}">Edit</a>
            </td>
        </tr>
        @endforeach
    </table>
@else
    <a href="{{ route('siswa.tempat.create') }}">+ Input Tempat PKL</a>
@endif

<br>
<a href="{{ route('siswa.dashboard') }}">Back</a>
