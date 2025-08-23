<h2>Edit Tempat PKL</h2>
<form method="POST" action="{{ route('siswa.tempat.update', $tempat->id) }}">
    @csrf
    @method('PUT')

    <label>Nama Siswa:</label>
    <input type="text" name="nama_siswa" value="{{ $tempat->nama_siswa }}" required><br>

    <label>Kelas:</label>
    <select name="kelas" required>
        <option value="XI RPL" {{ $tempat->kelas == 'XI RPL' ? 'selected' : '' }}>XI RPL</option>
        <option value="XI DKV" {{ $tempat->kelas == 'XI DKV' ? 'selected' : '' }}>XI DKV</option>
    </select><br>

    <label>Program Keahlian:</label>
    <select name="program_keahlian" required>
        <option value="RPL" {{ $tempat->program_keahlian == 'RPL' ? 'selected' : '' }}>RPL</option>
        <option value="DKV" {{ $tempat->program_keahlian == 'DKV' ? 'selected' : '' }}>DKV</option>
    </select><br>

    <label>Tempat PKL:</label>
    <input type="text" name="tempat_pkl" value="{{ $tempat->tempat_pkl }}" required><br>

    <label>Status:</label>
    <input type="text" value="Menunggu" disabled><br><br>

    <button type="submit">Update</button>
</form>
<a href="{{route('siswa.dashboard')}}">back</a>
