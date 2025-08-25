<form action="{{ route('siswa.tempat.update', $tempat->id) }}" method="POST">
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

    <button type="submit" class="btn-submit">Update</button>
</form>
<a href="{{ route('siswa.tempat.index')}}">back</a>
