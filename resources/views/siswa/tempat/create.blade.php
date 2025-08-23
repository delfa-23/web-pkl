<h2>Input Tempat PKL</h2>
<form method="POST" action="{{ route('siswa.tempat.store') }}">
    @csrf

    <label>Nama Siswa:</label><br>
    <input type="text" name="nama_siswa" required><br>

    <label>Kelas:</label><br>
    <select name="kelas" required>
        <option value="XI RPL">XI RPL</option>
        <option value="XI DKV">XI DKV</option>
    </select><br>

    <label>Program Keahlian:</label><br>
    <select name="program_keahlian" required>
        <option value="RPL">RPL</option>
        <option value="DKV">DKV</option>
    </select><br>

    <label>Tempat PKL:</label><br>
    <input type="text" name="tempat_pkl" required><br><br>

    <button type="submit">Simpan</button>
</form>
<a href="{{route('siswa.dashboard')}}">back</a>
