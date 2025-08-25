<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Siswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
  <div class="container mx-auto p-6 max-w-lg">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-semibold text-[#1d9a96]">
        <i class="fas fa-user-graduate"></i> Tambah Data Siswa
      </h1>
      <a href="{{ route('admin.siswa.index') }}"
         class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg shadow hover:bg-gray-300">
        Kembali
      </a>
    </div>

    <!-- Card Form -->
    <div class="bg-white p-6 rounded-lg shadow">
    <form action="{{ route('admin.siswa.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
        <label class="block text-sm font-medium">Nama Lengkap</label>
        <input type="text" name="nama" class="w-full border rounded-lg px-3 py-2" required>
        </div>

        <div>
        <label class="block text-sm font-medium">NIS</label>
        <input type="text" name="nis" class="w-full border rounded-lg px-3 py-2">
        </div>

        <div>
        <label class="block text-sm font-medium">NISN</label>
        <input type="text" name="nisn" class="w-full border rounded-lg px-3 py-2">
        </div>

        <div>
        <label class="block text-sm font-medium">ID Login</label>
        <input type="text" name="id_login" class="w-full border rounded-lg px-3 py-2" required>
        </div>

        <div>
        <label class="block text-sm font-medium">Password</label>
        <input type="password" name="password" class="w-full border rounded-lg px-3 py-2" required>
        </div>

        <div>
        <label class="block text-sm font-medium">Kelas</label>
        <select name="kelas" class="w-full border rounded-lg px-3 py-2" required>
            <option value="">-- Pilih Kelas --</option>
            <option value="XI - RPL">XI - RPL</option>
            <option value="XI - DKV">XI - DKV</option>
        </select>
        </div>

        <div>
        <label class="block text-sm font-medium">Jurusan</label>
        <select name="jurusan" class="w-full border rounded-lg px-3 py-2" required>
            <option value="">-- Pilih Jurusan --</option>
            <option value="RPL">RPL</option>
            <option value="DKV">DKV</option>
        </select>
        </div>

        <div>
        <label class="block text-sm font-medium">No Telepon</label>
        <input type="text" name="telepon" class="w-full border rounded-lg px-3 py-2">
        </div>



        <div>
            <label class="block text-sm font-medium">Alamat</label>
            <textarea name="alamat" class="w-full border rounded-lg px-3 py-2"></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" class="w-full border rounded-lg px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="w-full border rounded-lg px-3 py-2">
        </div>

        <div>
        <label class="block text-sm font-medium">Nama Orang Tua/Wali</label>
        <input type="text" name="nama_orangtua" class="w-full border rounded-lg px-3 py-2">
        </div>

        <div>
        <label class="block text-sm font-medium">No Telepon Orang Tua</label>
        <input type="text" name="telepon_orangtua" class="w-full border rounded-lg px-3 py-2">
        </div>

        <div class="pt-4">
            <button type="submit"
            class="w-full bg-[#1d9a96] text-white py-2 rounded-lg shadow hover:bg-[#16817a]">
            <i class="fas fa-save"></i> Simpan
        </button>
        </div>
    </form>
    </div>


  </div>
</body>
</html>
