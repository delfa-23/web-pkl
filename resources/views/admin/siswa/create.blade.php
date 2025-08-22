<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Siswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">

  <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-2xl">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Tambah Data Siswa</h1>

    <form action="{{ route('admin.siswa.store') }}" method="POST" class="space-y-4">
      @csrf

      <!-- Nama Lengkap -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
        <input type="text" name="nama" placeholder="Nama Lengkap Siswa"
          class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-blue-200" required>
      </div>

      <!-- NIS -->
      <div>
        <label class="block text-sm font-medium text-gray-700">NIS</label>
        <input type="text" name="nis" placeholder="Nomor Induk Siswa"
          class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-blue-200" >
      </div>

      <!-- NISN -->
      <div>
        <label class="block text-sm font-medium text-gray-700">NISN</label>
        <input type="text" name="nisn" placeholder="Nomor Induk Siswa Nasional"
          class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-blue-200" >
      </div>

      <!-- Nomor Telepon -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
        <input type="text" name="telepon" placeholder="08xxxxxxxxxx"
          class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-blue-200" required>
      </div>

      <!-- Jenis Kelamin -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
        <select name="jenis_kelamin" class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-blue-200" required>
          <option value="">-- Pilih Jenis Kelamin --</option>
          <option value="Laki-laki">Laki-laki</option>
          <option value="Perempuan">Perempuan</option>
        </select>
      </div>

      <!-- Kelas -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Kelas</label>
        <input type="text" name="kelas" placeholder="Contoh: XI-RPL"
          class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-blue-200" required>
      </div>

      <!-- Status -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Status</label>
        <select name="status" class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-blue-200" required>
          <option value="" disabled selected hidden>-- Pilih Status --</option>
          <option value="Aktif">Aktif</option>
          <option value="Nonaktif">Nonaktif</option>
        </select>
      </div>

      <!-- Kehadiran -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Kehadiran</label>
        <input type="number" name="kehadiran" placeholder="Masukkan jumlah kehadiran"
          class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-blue-200" required>
      </div>

      <!-- ID Login -->
      <div>
        <label class="block text-sm font-medium text-gray-700">ID Login</label>
        <input type="text" name="login_id" placeholder="ID Login"
          class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-blue-200" required>
      </div>

      <!-- Password -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" name="password" placeholder="Password"
          class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-blue-200" required>
      </div>

      <!-- Tombol -->
      <div class="flex justify-between mt-6">
        <a href="{{ route('admin.siswa.index') }}"
           class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">Kembali</a>
        <button type="submit"
           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
      </div>
    </form>
  </div>

</body>
</html>
