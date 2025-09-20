<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Aktivitas Harian | SyifaPKL</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50 text-gray-800">
  <div class="container mx-auto p-6 max-w-lg">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-semibold text-[#1d9a96]">
        <i class="fas fa-edit"></i> Edit Aktivitas Harian
      </h1>
      <a href="{{ route('siswa.activity.index') }}"
         class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg shadow hover:bg-gray-300 flex items-center gap-2">
        <i class="fas fa-arrow-left"></i> Kembali
      </a>
    </div>

    <!-- Error & Alert -->
    @if ($errors->any())
      <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        <ul class="list-disc pl-5">
          @foreach ($errors->all() as $err)
            <li>{{ $err }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @if (session('error'))
      <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        {{ session('error') }}
      </div>
    @endif

    @if (session('success'))
      <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
      </div>
    @endif

    <!-- Card Form -->
    <div class="bg-white p-6 rounded-lg shadow">
      <form action="{{ route('siswa.activity.update', $activity->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Tanggal -->
        <div>
          <label for="tanggal" class="block font-medium">Tanggal & Waktu</label>
          <input type="datetime-local" name="tanggal" id="tanggal"
                 value="{{ old('tanggal', date('Y-m-d\TH:i', strtotime($activity->tanggal))) }}"
                 required
                 class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]">
        </div>

        <!-- Kegiatan -->
        <div>
          <label for="kegiatan" class="block font-medium">Kegiatan</label>
          <textarea name="kegiatan" id="kegiatan" rows="3" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]">{{ old('kegiatan', $activity->kegiatan) }}</textarea>
        </div>

        <!-- Foto -->
        <div>
          <label for="foto" class="block font-medium">Foto</label>
          <input type="file" name="foto" id="foto" accept="image/*"
                 class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]">
          @if ($activity->foto)
            <div class="mt-3">
              <p class="text-sm text-gray-600 mb-1">Foto saat ini:</p>
              <img src="{{ asset('storage/' . $activity->foto) }}" alt="Foto Aktivitas"
                   class="rounded-lg border max-w-[200px]">
            </div>
          @endif
        </div>

        <!-- Tombol -->
        <div class="flex justify-end gap-3">
          <button type="submit"
                  class="px-4 py-2 bg-[#1d9a96] text-white rounded-lg shadow hover:bg-[#17807c] flex items-center gap-2">
            <i class="fas fa-save"></i> Update
          </button>
        </div>
      </form>
    </div>
  </div>
</body>

</html>
