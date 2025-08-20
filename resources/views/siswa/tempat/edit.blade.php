<h2>Edit Tempat PKL</h2>
<form action="{{ route('siswa.tempat.update', $tempat->id) }}" method="POST">
    @csrf
    @method('PUT')

    Nama: <input type="text" name="nama" value="{{ $tempat->nama }}" required><br>
    Jurusan: <input type="text" name="jurusan" value="{{ $tempat->jurusan }}" required><br>
    Nama Perusahaan: <input type="text" name="nama_perusahaan" value="{{ $tempat->nama_perusahaan }}" required><br>
    Tempat PKL: <input type="text" name="tempat_pkl" value="{{ $tempat->tempat_pkl }}" required><br>

    <button type="submit">Update</button>
</form>

<a href="{{ route('siswa.tempat.index') }}">Back</a>
