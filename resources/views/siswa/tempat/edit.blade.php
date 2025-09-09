<h2>Edit Data Tempat PKL</h2>

<form
    action="{{ session('role') == 'admin' ? route('admin.tempat.update', $tempat->id) : route('siswa.tempat.update', $tempat->id) }}"
    method="POST">
    @csrf
    @method('PUT')

    <label>Nama Perusahaan:</label>
    <input type="text" name="nama_perusahaan" value="{{ $tempat->nama_perusahaan }}" required>

    <label>Alamat Perusahaan:</label>
    <input type="text" name="alamat_perusahaan" value="{{ $tempat->alamat_perusahaan }}" required>

    <label>Telepon Perusahaan:</label>
    <input type="text" name="telepon_perusahaan" value="{{ $tempat->telepon_perusahaan }}">

    <label>Pembimbing Perusahaan:</label>
    <input type="text" name="pembimbing_perusahaan" value="{{ $tempat->pembimbing_perusahaan }}">

    <hr>
    <h4>Anggota PKL</h4>

    <div id="anggota-container">
        @foreach($tempat->siswas as $anggota)
            <div style="margin-top:5px;">
                <select name="anggota[]">
                    <option value="">-- Pilih Siswa --</option>
                    @foreach($siswas as $s)
                        <option value="{{ $s->id }}"
                            {{ $anggota && $s->id == $anggota->id ? 'selected' : '' }}>
                            {{ $s->nama }}
                        </option>
                    @endforeach
                </select>
                <button type="button" onclick="this.parentNode.remove()">Hapus</button>
            </div>
        @endforeach
    </div>
    <button type="button" onclick="tambahAnggota()">+ Tambah Anggota</button>

    <br><br>
    <button type="submit" class="btn-submit">Update</button>
</form>

<a href="{{ session('role') == 'admin' ? route('admin.tempat.index') : route('siswa.dashboard') }}">
    Back
</a>

<script>
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
