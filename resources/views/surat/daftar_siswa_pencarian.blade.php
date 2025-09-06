<h2>Daftar Siswa - Surat Pengantar Pencarian Tempat PKL</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Kelas/Jurusan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($siswas as $siswa)
            <tr>
                <td>{{ $siswa->nama }}</td>
                <td>{{ $siswa->kelas }} / {{ $siswa->jurusan }}</td>
                <td>
                    <a href="{{ route('surat.pencarian', $siswa->id) }}" class="btn btn-primary btn-sm">
                        Lihat Template
                    </a>
                    <a href="{{ route('surat.download_pencarian', $siswa->id) }}" class="btn btn-success btn-sm">
                        Download PDF
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ route('admin.dashboard') }}">Kembali</a>
