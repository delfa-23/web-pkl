<h2>Tempat PKL</h2>

@if($tempat->count() > 0)
    <table border="1" cellpadding="5">
        <tr>
            <th>Nama Perusahaan</th>
            <th>Alamat</th>
            <th>Telepon</th>
            <th>Pembimbing</th>
            <th>Anggota</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        @foreach($tempat as $t)
        <tr>
            <td>{{ $t->nama_perusahaan }}</td>
            <td>{{ $t->alamat_perusahaan }}</td>
            <td>{{ $t->telepon_perusahaan }}</td>
            <td>{{ $t->pembimbing_perusahaan }}</td>
            <td>
                <ul style="padding-left:15px; margin:0;">
                    @foreach($t->siswas as $anggota)
                        <li>{{ $anggota->nama }} ({{ $anggota->jurusan }})</li>
                    @endforeach
                </ul>
            </td>
            <td>{{ $t->status_label }}</td>
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
