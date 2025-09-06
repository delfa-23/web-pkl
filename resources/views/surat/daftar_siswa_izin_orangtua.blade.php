<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Siswa | SyifaPKL</title>

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    .bg-brand { background-color: #1d9a96; }
    .text-brand { color: #1d9a96; }
    .hover\:bg-brand-dark:hover { background-color: #157872; }
  </style>
</head>
<body class="bg-gray-50 text-gray-800">
  <div class="container mx-auto p-6">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-semibold text-brand flex items-center gap-2">
        <i class="fas fa-users text-brand"></i> Daftar Siswa
      </h1>
    </div>

    <!-- Tabel -->
    <div class="overflow-x-auto bg-white rounded-lg shadow">
      <table class="w-full text-left border-collapse">
        <thead class="bg-gray-100 text-brand">
          <tr>
            <th class="px-4 py-3 border-b">Nama</th>
            <th class="px-4 py-3 border-b">Kelas / Jurusan</th>
            <th class="px-4 py-3 border-b text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($siswas as $siswa)
          <tr class="hover:bg-gray-50">
            <td class="px-4 py-3 border-b">{{ $siswa->nama }}</td>
            <td class="px-4 py-3 border-b">{{ $siswa->kelas }} / {{ $siswa->jurusan }}</td>
            <td class="px-4 py-3 border-b">
              <div class="flex items-center justify-center gap-2">
                <!-- Lihat Template -->
                <a href="{{ route('surat.izin_orangtua', $siswa->id) }}"
                   class="p-2 rounded-lg bg-brand/10 text-brand hover:bg-brand/20"
                   title="Lihat Template">
                  <i class="fa-solid fa-eye"></i>
                </a>
                <!-- Download PDF -->
                <a href="{{ route('surat.download_izin', $siswa->id) }}"
                    class="flex items-center gap-2 px-3 py-2 rounded-lg text-white shadow text-sm font-medium"
                    style="background-color:#d5ad71;"
                    title="Download PDF">
                    <i class="fa-solid fa-file-pdf text-[#1d9a96]"></i>
                    Download PDF
                </a>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <!-- Tombol kembali -->
    <div class="mt-6">
      <a href="{{ route('admin.dashboard')}}" class="text-brand hover:underline flex items-center gap-2">
        <i class="fas fa-arrow-left"></i> Kembali
      </a>
    </div>

  </div>
</body>
</html>
