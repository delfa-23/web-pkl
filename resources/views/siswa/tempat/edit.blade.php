<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Edit Tempat PKL</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .bg-brand { background-color:#1d9a96; color:#fff; }
    .anggota-row .form-select { max-width: 200px; }
    .anggota-row .badge { min-width: 120px; text-align: left; }
  </style>
</head>
<body class="bg-light">
<div class="container py-4">
  <h2 class="mb-4 text-brand">Edit Tempat PKL</h2>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
  @endif

  @php
      // Ambil role user dari session atau auth
      $role = session('role') ?? (auth()->user()?->role ?? 'siswa');
      $isAdmin = $role === 'admin';
  @endphp

  <form action="{{ $isAdmin ? route('admin.tempat.update', $tempat->id) : route('siswa.tempat.update', $tempat->id) }}" method="POST" id="form-edit-tempat">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label class="form-label">Nama Perusahaan</label>
      <input name="nama_perusahaan" class="form-control" required value="{{ old('nama_perusahaan', $tempat->nama_perusahaan) }}">
    </div>

    <div class="mb-3">
      <label class="form-label">Alamat Perusahaan</label>
      <textarea name="alamat_perusahaan" class="form-control" required>{{ old('alamat_perusahaan', $tempat->alamat_perusahaan) }}</textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Telepon Perusahaan</label>
      <input name="telepon_perusahaan" class="form-control" value="{{ old('telepon_perusahaan', $tempat->telepon_perusahaan) }}">
    </div>

    <div class="mb-3">
      <label class="form-label">Pembimbing Perusahaan</label>
      <input name="pembimbing_perusahaan" class="form-control" value="{{ old('pembimbing_perusahaan', $tempat->pembimbing_perusahaan) }}">
    </div>

    {{-- Status hanya untuk admin --}}
    @if($isAdmin)
      <div class="mb-3">
          <label class="form-label">Status</label>
          <select name="status" class="form-select">
              <option value="belum_terverifikasi" {{ $tempat->status=='belum_terverifikasi'?'selected':'' }}>Belum Terverifikasi</option>
              <option value="proses" {{ $tempat->status=='proses'?'selected':'' }}>Proses</option>
              <option value="diterima" {{ $tempat->status=='diterima'?'selected':'' }}>Diterima</option>
              <option value="ditolak" {{ $tempat->status=='ditolak'?'selected':'' }}>Ditolak</option>
          </select>
      </div>
    @endif

    <hr>
    <h5 class="mb-3">Anggota PKL</h5>

    <div id="anggota-container">
      {{-- Siswa login --}}
      @if(isset($siswaLogin))
        <div class="d-flex align-items-center gap-2 mb-2 anggota-row">
          <input type="hidden" name="anggota[]" value="{{ $siswaLogin->id }}" data-fixed="1">
          <span class="badge bg-secondary p-2">{{ $siswaLogin->nama }} (Anda)</span>
        </div>
      @endif

      {{-- Anggota lain --}}
      @foreach($tempat->siswas as $angg)
        @if(!isset($siswaLogin) || $angg->id != $siswaLogin->id)
          <div class="d-flex align-items-center gap-2 mb-2 anggota-row">
            <select name="anggota[]" class="form-select form-select-sm w-auto anggota-select">
              <option value="">-- Pilih Siswa --</option>
              @foreach($siswas as $s)
                @if(!isset($siswaLogin) || $s->id != $siswaLogin->id)
                  <option value="{{ $s->id }}" {{ $s->id == $angg->id ? 'selected' : '' }}>{{ $s->nama }}</option>
                @endif
              @endforeach
            </select>
            <button type="button" class="btn btn-danger btn-sm remove-anggota">Hapus</button>
          </div>
        @endif
      @endforeach
    </div>

    <button type="button" id="add-anggota-btn" class="btn btn-outline-secondary btn-sm mb-3">+ Tambah Anggota</button>

    <div class="d-flex justify-content-end">
      <a href="{{ $isAdmin ? route('admin.tempat.index') : route('siswa.tempat.index') }}" class="btn btn-secondary me-2">Batal</a>
      <button type="submit" class="btn bg-brand">Update</button>
    </div>
  </form>
</div>

<script>
const siswasOptions = `@foreach($siswas as $s)@if(!isset($siswaLogin) || $s->id != $siswaLogin->id)<option value="{{ $s->id }}">{{ addslashes($s->nama) }}</option>@endif @endforeach`;

document.getElementById('add-anggota-btn').addEventListener('click', function(){
  const container = document.getElementById('anggota-container');
  const div = document.createElement('div');
  div.className = 'd-flex align-items-center gap-2 mb-2 anggota-row';
  div.innerHTML = `
    <select name="anggota[]" class="form-select form-select-sm w-auto anggota-select">
      <option value="">-- Pilih Siswa --</option>
      ${siswasOptions}
    </select>
    <button type="button" class="btn btn-danger btn-sm remove-anggota">Hapus</button>
  `;
  container.appendChild(div);
  attachRemove(div.querySelector('.remove-anggota'));
  attachSelectListener(div.querySelector('.anggota-select'));
  refreshOptionStates();
});

function attachRemove(btn){
  btn.addEventListener('click', function(){
    this.parentNode.remove();
    refreshOptionStates();
  });
}
document.querySelectorAll('.remove-anggota').forEach(attachRemove);

function attachSelectListener(sel){
  sel.addEventListener('change', refreshOptionStates);
}
document.querySelectorAll('.anggota-select').forEach(attachSelectListener);

function refreshOptionStates(){
  const selects = Array.from(document.querySelectorAll('.anggota-select'));
  const chosen = selects.map(s => s.value).filter(v => v && v !== '');
  selects.forEach(sel => {
    Array.from(sel.options).forEach(opt => {
      if(opt.value === '') { opt.disabled = false; return; }
      if(opt.value === sel.value) { opt.disabled = false; return; }
      opt.disabled = chosen.includes(opt.value);
    });
  });
}

refreshOptionStates();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
