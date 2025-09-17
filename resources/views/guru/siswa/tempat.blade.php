<div class="container">
    <h1 class="mb-4">Daftar Tempat PKL</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Perusahaan</th>
                <th>Alamat</th>
                <th>Status</th>
                <th>Jumlah Siswa</th>
                <th>Nama Siswa</th>
            </tr>
        </thead>
        <tbody>
            @foreach($siswa->tempats as $tempat)
                <tr>
                    <td>{{ $tempat->nama_perusahaan }}</td>
                    <td>{{ $tempat->alamat_perusahaan }}</td>
                    <td>{{ $tempat->status_label }}</td>
                    <td>{{ $tempat->siswas->count() }}</td>
                    <td>
                        @if($tempat->siswas->count())
                            <ul class="mb-0">
                                @foreach($tempat->siswas as $s)
                                    {{ $s->nama }} ({{ $s->jurusan }})
                                @endforeach
                            </ul>
                        @else
                            <em>Belum ada siswa</em>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('guru.dashboard') }}" class="btn btn-secondary mt-3">
        Kembali ke Dashboard
    </a>
</div>
