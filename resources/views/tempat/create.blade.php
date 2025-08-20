<h2>Input Tempat PKL</h2>
<form method="POST" action="{{ route('siswa.tempat.store') }}">
    @csrf
    <label>Nama:</label><br>
    <input type="text" name="nama"><br>
    <label>Jurusan:</label><br>
    <input type="text" name="jurusan"><br>
    <label>Nama Perusahaan:</label><br>
    <input type="text" name="nama_perusahaan"><br>
    <label>Tempat PKL:</label><br>
    <input type="text" name="tempat_pkl"><br><br>
    <button type="submit">Simpan</button>
</form>
