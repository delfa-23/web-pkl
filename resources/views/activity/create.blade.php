<h2>Tambah Aktivitas Harian</h2>
<form action="{{ route('siswa.activity.store') }}" method="POST">
    @csrf
    Tanggal & Waktu:
    <input type="datetime-local" name="tanggal" required><br>

    Kegiatan:
    <textarea name="kegiatan" required></textarea><br>

    <button type="submit">Simpan</button>
</form>

<a href="{{ route('siswa.activity.index') }}">Kembali</a>
