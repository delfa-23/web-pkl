<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Siswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-800">
  <div class="container mx-auto p-6 max-w-lg">

    <div class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-semibold text-[#1d9a96]">
        <i class="fas fa-user-plus"></i> Tambah Data Siswa
      </h1>
      <a href="{{ route('admin.siswa.index') }}"
         class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg shadow hover:bg-gray-300 flex items-center gap-2">
        <i class="fas fa-arrow-left"></i> Kembali
      </a>
    </div>

    <!-- Card Form -->
    <div class="bg-white p-6 rounded-lg shadow">
      <form action="{{ route('admin.siswa.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
          <label class="block font-medium">Nama Lengkap</label>
          <input type="text" name="nama" placeholder="Nama Siswa" required
                 class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]">
        </div>

        <div>
          <label class="block font-medium">NIS</label>
          <input type="text" name="nis" placeholder="NIS"
                 class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]">
        </div>

        <div>
          <label class="block font-medium">NISN</label>
          <input type="text" name="nisn" placeholder="NISN"
                 class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]">
        </div>

        <div>
          <label class="block font-medium">Nomor Telepon</label>
          <input type="text" name="telepon" placeholder="08xxxxxxxxxx"
                 class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]">
        </div>

        <div>
          <label class="block font-medium">Jenis Kelamin</label>
          <select name="jenis_kelamin" required
                  class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]">
            <option value="" disabled selected hidden>-- Pilih Jenis Kelamin --</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
          </select>
        </div>

        <div>
          <label class="block font-medium">Kelas</label>
          <input type="text" name="kelas" placeholder="Contoh: XI-RPL"
                 class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]">
        </div>

        <div>
          <label class="block font-medium">Status</label>
          <select name="status" required
                  class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]">
            <option value="" disabled selected hidden>-- Pilih Status --</option>
            <option value="Aktif">Aktif</option>
            <option value="Tidak Aktif">Tidak Aktif</option>
          </select>
        </div>

        <div>
          <label class="block font-medium">Kehadiran</label>
          <select name="kehadiran" required
                  class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]">
            <option value="" disabled selected hidden>-- Pilih Kehadiran --</option>
            <option value="Hadir">Hadir</option>
            <option value="Sakit">Sakit</option>
            <option value="Izin">Izin</option>
            <option value="Alpa">Alpa</option>
          </select>
        </div>

        <div>
          <label class="block font-medium">ID Login</label>
          <input type="text" name="id_login" placeholder="ID Login" required
                 class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]">
        </div>

        <div>
          <label class="block font-medium">Password</label>
          <input type="password" name="password" placeholder="Password" required
                 class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]">
        </div>

        <div class="flex justify-end gap-3">
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
</body>
</html>
