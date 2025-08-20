<h2>Tempat PKL</h2>
@if($tempat)
    <p><b>Nama:</b> {{ $tempat->nama }}</p>
    <p><b>Jurusan:</b> {{ $tempat->jurusan }}</p>
    <p><b>Perusahaan:</b> {{ $tempat->nama_perusahaan }}</p>
    <p><b>Tempat PKL:</b> {{ $tempat->tempat_pkl }}</p>

    <!-- 🔹 Tambahin tombol edit disini -->
    <a href="{{ route('siswa.tempat.edit', $tempat->id) }}">Edit</a>

@else
    <a href="{{ route('siswa.tempat.create') }}">+ Input Tempat PKL</a>
@endif

<br>
<a href="{{ route('siswa.dashboard') }}">Back</a>
