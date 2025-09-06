<h2>Tempat PKL</h2>

    <table border="1" cellpadding="5">
        <tr>
            <th>Nama Siswa</th>
            <th>Jurusan</th>
            <th>Nama Perusahaan</th>
            <th>Alamat Perusahaan</th>
            <th>Status</th>
        </tr>
        <tr>
            <td>{{ $siswa->nama }}</td>
            <td>{{ $siswa->jurusan }}</td>
            <td>{{ $siswa->tempatPKL->nama_perusahaan }}</td>
            <td>{{ $siswa->tempatPKL->alamat_perusahaan }}</td>
            <td>{{ $siswa->tempatPKL->status_label }}</td>
        </tr>
    </table>

<br>
<a href="{{ route('siswa.dashboard') }}">Back</a>
