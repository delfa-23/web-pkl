<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Guru</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-800">
  <div class="container mx-auto p-6 max-w-lg">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-semibold text-[#1d9a96]">
        <i class="fas fa-user-plus"></i> Tambah Data Guru
      </h1>
      <a href="{{ route('admin.guru.index') }}"
         class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg shadow hover:bg-gray-300 flex items-center gap-2">
        <i class="fas fa-arrow-left"></i> Kembali
      </a>
    </div>
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
      <form action="{{ route('admin.guru.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
          <label class="block font-medium">Nama Lengkap</label>
          <input type="text" name="nama" required placeholder="Nama Lengkap"
                 class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]">
        </div>

        <div>
          <label class="block font-medium">NIP</label>
          <input type="text" name="nip" placeholder="NIP"
                 class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]">
        </div>

        <div>
          <label class="block font-medium">NUPTK</label>
          <input type="text" name="nuptk" placeholder="NUPTK"
                 class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]">
        </div>

        <div>
          <label class="block font-medium">Jabatan</label>
          <input type="text" name="jabatan" required placeholder="Jabatan"
                 class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]">
        </div>

        <div>
          <label class="block font-medium">ID Login</label>
          <input type="text" name="id_login" required placeholder="ID Login"
                 class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]">
        </div>

        <div>
          <label class="block font-medium">Password</label>
          <input type="password" name="password" required placeholder="Password"
                 class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]">
        </div>

        <div class="flex justify-end gap-3">
          <button type="reset"
                  class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
            <i class="fas fa-undo"></i> Reset
          </button>
          <button type="submit"
                class="px-4 py-2 bg-[#1d9a96] text-white rounded-lg shadow hover:bg-[#17807c] flex items-center gap-2">
            <i class="fas fa-save"></i> Simpan
        </button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
