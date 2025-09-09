
<h2>Input Tempat PKL</h2>

<form action="{{ route('siswa.tempat.store') }}" method="POST">
    @csrf

    <label>Nama Perusahaan:</label>
    <input type="text" name="nama_perusahaan" required>

    <label>Alamat Perusahaan:</label>
    <input type="text" name="alamat_perusahaan" required>

    <label>Telepon Perusahaan:</label>
    <input type="text" name="telepon_perusahaan">

    <label>Pembimbing Perusahaan:</label>
    <input type="text" name="pembimbing_perusahaan">

    <hr>
    <h4>Anggota PKL</h4>

    {{-- Siswa yang login --}}
    <input type="hidden" name="anggota[]" value="{{ $siswaLogin->id }}">
    <p>{{ $siswaLogin->nama }} (Anda)</p>

    {{-- Container untuk anggota tambahan --}}
    <div id="anggota-container"></div>
    <button type="button" onclick="tambahAnggota()">+ Tambah Anggota</button>

    <br><br>
    <button type="submit">Simpan</button>
</form>

<script>
    // Template opsi siswa lain
    const siswasOptions = `
        <option value="">-- Pilih Siswa --</option>
        @foreach($siswas as $s)
            <option value="{{ $s->id }}">{{ $s->nama }}</option>
        @endforeach
    `;

    function tambahAnggota() {
        const container = document.getElementById('anggota-container');
        const wrap = document.createElement('div');
        wrap.style.marginTop = '5px';
        wrap.innerHTML = `
            <select name="anggota[]">
                ${siswasOptions}
            </select>
            <button type="button" onclick="this.parentNode.remove()">Hapus</button>
        `;
        container.appendChild(wrap);
    }
</script>
