<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Input Tempat PKL</title>
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
        <i class="fas fa-building"></i> Input Tempat PKL
      </h1>
      <a href="{{ route('siswa.dashboard') }}"
         class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg shadow hover:bg-gray-300 flex items-center gap-2">
        <i class="fas fa-arrow-left"></i> Kembali
      </a>
    </div>

    <!-- Error Handling -->
    @if ($errors->any())
      <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
          <ul class="list-disc pl-5">
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif

    @if (session('error'))
      <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
          {{ session('error') }}
      </div>
    @endif

    <!-- Card Form -->
    <div class="bg-white p-6 rounded-lg shadow">
      <form method="POST" action="{{ route('siswa.tempat.store') }}" class="space-y-4">
        @csrf

        <!-- Perusahaan -->
        <div>
          <label class="block font-medium">Nama Perusahaan</label>
          <input type="text" name="nama_perusahaan" required placeholder="Masukkan nama perusahaan"
                 class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]">
        </div>

        <div>
          <label class="block font-medium">Alamat Perusahaan</label>
          <textarea name="alamat_perusahaan" required placeholder="Masukkan alamat perusahaan"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]"></textarea>
        </div>

        <div>
          <label class="block font-medium">Telepon Perusahaan</label>
          <input type="text" name="telepon_perusahaan" placeholder="Masukkan nomor telepon"
                 class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]">
        </div>

        <div>
          <label class="block font-medium">Instruktur Perusahaan</label>
          <input type="text" name="instruktur_perusahaan" placeholder="Masukkan nama Instruktur Perusahaan"
                 class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]">
        </div>

        <!-- Anggota PKL -->
        <div class="pt-4 border-t">
          <h3 class="text-lg font-semibold text-[#1d9a96] mb-2">Anggota PKL</h3>

          <!-- Siswa yang login -->
          <input type="hidden" name="anggota[]" value="{{ $siswaLogin->id }}">
          <p class="text-sm text-gray-700 mb-2">
            <i class="fas fa-user"></i> {{ $siswaLogin->nama }} <span class="text-gray-500">(Anda)</span>
          </p>

          <!-- Container anggota tambahan -->
          <div id="anggota-container" class="space-y-2"></div>

          <button type="button" onclick="tambahAnggota()"
                  class="mt-2 px-3 py-1 bg-[#1d9a96] text-white rounded-lg text-sm hover:bg-[#17807c]">
            <i class="fas fa-plus"></i> Tambah Anggota
          </button>
        </div>

        <!-- Tombol -->
        <div class="flex justify-end gap-3 pt-4 border-t">
          <button type="reset"
                  class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
            <i class="fas fa-undo"></i> Reset
          </button>
          <button type="submit"
                  class="px-4 py-2 bg-[#1d9a96] text-white rounded-lg shadow hover:bg-[#17807c]">
            <i class="fas fa-save"></i> Simpan
          </button>
        </div>
      </form>
    </div>
  </div>

<script>
  // Data siswa dari backend
  const siswaData = [
    @foreach($siswas as $s)
      { value: "{{ $s->id }}", text: "{{ $s->nama }} ({{ $s->jurusan }})" },
    @endforeach
  ];

  // Refresh semua dropdown agar siswa yg sudah dipilih hilang dari pilihan lain
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
          // hanya tambahkan opsi jika belum dipilih di dropdown lain, atau itu opsi yg sekarang
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

  // Tambah dropdown anggota
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

    // Inisialisasi TomSelect
    let select = wrap.querySelector('.anggota-select');
    let ts = new TomSelect(select, {
      placeholder: 'Pilih siswa...',
      maxItems: 1,
      allowEmptyOption: true,
      onChange: function() { refreshDropdowns(); }
    });

    refreshDropdowns();
  }

  // Hapus dropdown anggota
  function hapusDropdown(btn) {
    let select = btn.parentNode.querySelector('.anggota-select');
    if (select.tomselect) {
      select.tomselect.destroy();
    }
    btn.parentNode.remove();
    refreshDropdowns();
  }
</script>



</body>
</html>
