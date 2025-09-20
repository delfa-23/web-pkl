<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Edit Tempat PKL</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
</head>
<body class="bg-gray-50 text-gray-800">
<div class="container mx-auto p-6 max-w-lg">

  <!-- Header -->
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold text-[#1d9a96]">
      <i class="fas fa-building"></i> Edit Tempat PKL
    </h1>
  </div>

  <!-- Error Handling -->
  @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
      <ul class="list-disc pl-5">
        @foreach ($errors->all() as $e)
          <li>{{ $e }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  @php
      // Ambil role user dari session atau auth
      $role = session('role') ?? (auth()->user()?->role ?? 'siswa');
      $isAdmin = $role === 'admin';
  @endphp

  <!-- Card Form -->
  <div class="bg-white p-6 rounded-lg shadow">
    <form action="{{ $isAdmin ? route('admin.tempat.update', $tempat->id) : route('siswa.tempat.update', $tempat->id) }}"
          method="POST" class="space-y-4">
      @csrf
      @method('PUT')

      <!-- Perusahaan -->
      <div>
        <label class="block font-medium">Nama Perusahaan</label>
        <input type="text" name="nama_perusahaan" required
               value="{{ old('nama_perusahaan', $tempat->nama_perusahaan) }}"
               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]">
      </div>

      <div>
        <label class="block font-medium">Alamat Perusahaan</label>
        <textarea name="alamat_perusahaan" required
                  class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]">{{ old('alamat_perusahaan', $tempat->alamat_perusahaan) }}</textarea>
      </div>

      <div>
        <label class="block font-medium">Telepon Perusahaan</label>
        <input type="text" name="telepon_perusahaan"
               value="{{ old('telepon_perusahaan', $tempat->telepon_perusahaan) }}"
               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]">
      </div>

      <div>
        <label class="block font-medium">Pembimbing Perusahaan</label>
        <input type="text" name="pembimbing_perusahaan"
               value="{{ old('pembimbing_perusahaan', $tempat->pembimbing_perusahaan) }}"
               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]">
      </div>

      <!-- Status hanya admin -->
      @if($isAdmin)
        <div>
          <label class="block font-medium">Status</label>
          <select name="status"
                  class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]">
            <option value="belum_terverifikasi" {{ $tempat->status=='belum_terverifikasi'?'selected':'' }}>Belum Terverifikasi</option>
            <option value="proses" {{ $tempat->status=='proses'?'selected':'' }}>Proses</option>
            <option value="diterima" {{ $tempat->status=='diterima'?'selected':'' }}>Diterima</option>
            <option value="ditolak" {{ $tempat->status=='ditolak'?'selected':'' }}>Ditolak</option>
          </select>
        </div>
      @endif

      <!-- Anggota PKL -->
      <div class="pt-4 border-t">
        <h3 class="text-lg font-semibold text-[#1d9a96] mb-2">Anggota PKL</h3>

        <!-- Siswa login -->
        @if(isset($siswaLogin))
          <input type="hidden" name="anggota[]" value="{{ $siswaLogin->id }}" data-fixed="1">
          <p class="text-sm text-gray-700 mb-2">
            <i class="fas fa-user"></i> {{ $siswaLogin->nama }}
            <span class="text-gray-500">(Anda)</span>
          </p>
        @endif

        <!-- Anggota lama -->
        <div id="anggota-container" class="space-y-2">
          @foreach($tempat->siswas as $angg)
            @if(!isset($siswaLogin) || $angg->id != $siswaLogin->id)
              <div class="flex items-center gap-2">
                <select name="anggota[]" class="anggota-select w-full">
                  <option value="">-- Pilih Siswa --</option>
                  @foreach($siswas as $s)
                    @if(!isset($siswaLogin) || $s->id != $siswaLogin->id)
                      <option value="{{ $s->id }}" {{ $s->id == $angg->id ? 'selected' : '' }}>
                        {{ $s->nama }} ({{ $s->jurusan }})
                      </option>
                    @endif
                  @endforeach
                </select>
                <button type="button" onclick="hapusDropdown(this)"
                        class="px-3 py-2 bg-red-500 text-white rounded-lg text-sm hover:bg-red-600">
                  Hapus
                </button>
              </div>
            @endif
          @endforeach
        </div>

        <button type="button" onclick="tambahAnggota()"
                class="mt-2 px-3 py-1 bg-[#1d9a96] text-white rounded-lg text-sm hover:bg-[#17807c]">
          <i class="fas fa-plus"></i> Tambah Anggota
        </button>
      </div>

      <!-- Tombol -->
      <div class="flex justify-end gap-3 pt-4 border-t">
        <a href="{{ $isAdmin ? route('admin.tempat.index') : route('siswa.tempat.index') }}"
           class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
          <i class="fas fa-arrow-left"></i> Batal
        </a>
        <button type="submit"
                class="px-4 py-2 bg-[#1d9a96] text-white rounded-lg shadow hover:bg-[#17807c]">
          <i class="fas fa-save"></i> Update
        </button>
      </div>
    </form>
  </div>
</div>

<script>
  const siswaData = [
    @foreach($siswas as $s)
      @if(!isset($siswaLogin) || $s->id != $siswaLogin->id)
        { value: "{{ $s->id }}", text: "{{ $s->nama }} ({{ $s->jurusan }})" },
      @endif
    @endforeach
  ];

  function refreshDropdowns() {
    let selectedValues = [];
    document.querySelectorAll('.anggota-select').forEach(select => {
      if (select.tomselect) {
        const val = select.tomselect.getValue();
        if (val) selectedValues.push(val);
      }
    });

    document.querySelectorAll('.anggota-select').forEach(select => {
      if (select.tomselect) {
        const currentValue = select.tomselect.getValue();
        select.tomselect.clearOptions();
        siswaData.forEach(opt => {
          if (!selectedValues.includes(opt.value) || opt.value === currentValue) {
            select.tomselect.addOption(opt);
          }
        });
        select.tomselect.refreshOptions(false);
        if (currentValue) {
          select.tomselect.setValue(currentValue, true);
        }
      }
    });
  }

  function tambahAnggota() {
    const container = document.getElementById('anggota-container');
    const wrap = document.createElement('div');
    wrap.className = "flex items-center gap-2 mt-2";
    wrap.innerHTML = `
      <select name="anggota[]" class="anggota-select w-full"></select>
      <button type="button" onclick="hapusDropdown(this)"
              class="px-3 py-2 bg-red-500 text-white rounded-lg text-sm hover:bg-red-600">
        Hapus
      </button>
    `;
    container.appendChild(wrap);

    let select = wrap.querySelector('.anggota-select');
    new TomSelect(select, {
      placeholder: 'Pilih siswa...',
      maxItems: 1,
      allowEmptyOption: true,
      onChange: function() { refreshDropdowns(); }
    });

    refreshDropdowns();
  }

  function hapusDropdown(btn) {
    let select = btn.parentNode.querySelector('.anggota-select');
    if (select.tomselect) {
      select.tomselect.destroy();
    }
    btn.parentNode.remove();
    refreshDropdowns();
  }

  document.querySelectorAll('.anggota-select').forEach(select => {
    new TomSelect(select, {
      placeholder: 'Pilih siswa...',
      maxItems: 1,
      allowEmptyOption: true,
      onChange: function() { refreshDropdowns(); }
    });
  });

  refreshDropdowns();
</script>
</body>
</html>
