<h2>Ubah Status Tempat PKL</h2>

<form action="{{ route('admin.tempat.update', $tempat->id) }}" method="POST">
    @csrf
    @method('PUT')

    <p><b>Nama Siswa:</b> {{ $tempat->siswa->nama }}</p>
    <p><b>Jurusan:</b> {{ $tempat->siswa->jurusan }}</p>
    <p><b>Perusahaan:</b> {{ $tempat->nama_perusahaan }}</p>

    <label for="status">Status:</label>
    <select name="status" id="status">
        <option value="belum_terverifikasi" {{ $tempat->status == 'belum_terverifikasi' ? 'selected' : '' }}>Belum Terverifikasi</option>
        <option value="proses" {{ $tempat->status == 'proses' ? 'selected' : '' }}>Proses</option>
        <option value="diterima" {{ $tempat->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
        <option value="ditolak" {{ $tempat->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
    </select>

    <br><br>
    <button type="submit">Simpan</button>
    <a href="{{ route('admin.tempat.index') }}">Kembali</a>
</form>
