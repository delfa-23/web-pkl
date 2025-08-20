<h2>Input Tempat PKL</h2>
<form action="{{ route('siswa.tempat.store') }}" method="POST">
    @csrf
    Nama: <input type="text" name="nama" required><br>
    Jurusan: <input type="text" name="jurusan" required><br>
    Nama Perusahaan: <input type="text" name="nama_perusahaan" required><br>
    Tempat PKL: <input type="text" name="tempat_pkl" required><br>

    <button type="submit">Simpan</button>
</form>

<a href="{{ route('siswa.dashboard') }}">Back</a>
