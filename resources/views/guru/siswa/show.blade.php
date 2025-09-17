<div class="container">
    <h1 class="mb-4">Daftar Tempat PKL</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Perusahaan</th>
                <th>Alamat</th>
                <th>Status</th>
                <th>Jumlah Siswa</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tempats as $tempat)
                <tr>
                    <td>{{ $tempat->nama_perusahaan }}</td>
                    <td>{{ $tempat->alamat_perusahaan }}</td>
                    <td>{{ $tempat->status_label }}</td>
                    <td>{{ $tempat->siswas->count() }}</td>
                    <td>
                        <a href="{{ route('guru.tempat.show', $tempat->id) }}" class="btn btn-sm btn-info">
                            Detail
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('guru.siswa.tempat') }}" class="btn btn-secondary mt-3">Kembali ke Daftar PKL Siswa</a>
</div>
