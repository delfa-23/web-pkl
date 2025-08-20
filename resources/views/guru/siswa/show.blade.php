<h1>Detail Siswa: {{ $siswa->nama }}</h1>
<p><b>Jurusan:</b> {{ $siswa->jurusan }}</p>

<h3>Tempat PKL</h3>
@if($siswa->tempatPKL)
    <p><b>Nama Perusahaan:</b> {{ $siswa->tempatPKL->nama_perusahaan }}</p>
    <p><b>Tempat PKL:</b> {{ $siswa->tempatPKL->tempat_pkl }}</p>
@else
    <p>Belum mengisi Tempat PKL</p>
@endif

<h3>Daily Activity</h3>
@if($siswa->activities->count() > 0)
    <ul>
        @foreach($siswa->activities as $a)
            <li>{{ date('d-m-Y H:i', strtotime($a->tanggal)) }} : {{ $a->kegiatan }}</li>
        @endforeach
    </ul>
@else
    <p>Belum ada aktivitas</p>
@endif

<a href="{{ route('guru.dashboard') }}">Kembali ke Dashboard</a>
