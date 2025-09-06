<h2>Edit Data Tempat PKL</h2>

<form
    action="{{ session('role') == 'admin' ? route('admin.tempat.update', $tempat->id) : route('siswa.tempat.update', $tempat->id) }}"
    method="POST">
    @csrf
    @method('PUT')

    {{-- Form data perusahaan --}}
    <label>Nama Perusahaan:</label>
    <input type="text" name="nama_perusahaan" value="{{ $tempat->nama_perusahaan }}" required>

    <label>Alamat Perusahaan:</label>
    <input type="text" name="alamat_perusahaan" value="{{ $tempat->alamat_perusahaan }}" required>

    <label>Telepon Perusahaan:</label>
    <input type="text" name="telepon_perusahaan" value="{{ $tempat->telepon_perusahaan }}">

    <label>Pembimbing Perusahaan:</label>
    <input type="text" name="pembimbing_perusahaan" value="{{ $tempat->pembimbing_perusahaan }}">

    {{-- Kalau admin, bisa ubah status --}}
    @if(session('role') == 'admin')
        <label>Status:</label>
        <select name="status">
            <option value="belum_terverifikasi" {{ $tempat->status == 'belum_terverifikasi' ? 'selected' : '' }}>Belum Terverifikasi</option>
            <option value="proses" {{ $tempat->status == 'proses' ? 'selected' : '' }}>Proses</option>
            <option value="diterima" {{ $tempat->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
            <option value="ditolak" {{ $tempat->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
        </select>
    @endif

    <button type="submit" class="btn-submit">Update</button>
</form>

{{-- Tombol back sesuai role --}}
<a href="{{ session('role') == 'admin' ? route('admin.tempat.index') : route('siswa.dashboard') }}">
    Back
</a>
