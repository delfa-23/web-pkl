<h2>Edit Aktivitas Harian</h2>
<form action="{{ route('siswa.activity.update', $activity->id) }}" method="POST">
    @csrf
    @method('PUT')

    Tanggal & Waktu:
    <input type="datetime-local" name="tanggal" value="{{ date('Y-m-d\TH:i', strtotime($activity->tanggal)) }}" required><br>

    Kegiatan:
    <textarea name="kegiatan" required>{{ $activity->kegiatan }}</textarea><br>

    <button type="submit">Update</button>
</form>

<a href="{{ route('siswa.activity.index') }}">Kembali</a>
