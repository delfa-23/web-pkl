<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Siswa | SyifaPKL</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
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
      <h1 class="text-2xl font-semibold text-brand">
        <i class="fas fa-users text-brand"></i> Data Siswa
      </h1>
      <a href="{{ route('admin.siswa.create') }}"
         class="px-4 py-2 bg-brand text-white rounded-lg shadow hover:bg-brand-dark flex items-center gap-2">
        <i class="fas fa-plus"></i> Tambah Siswa
      </a>
    </div>

    <!-- Pesan sukses -->
    @if(session('success'))
      <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
        {{ session('success') }}
      </div>
    @endif

    <!-- Tabel -->
    <div class="overflow-x-auto bg-white rounded-lg shadow">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-100 text-brand">
        <tr>
            <th class="px-4 py-3 border-b">No</th>
            <th class="px-4 py-3 border-b">Nama Lengkap</th>
            <th class="px-4 py-3 border-b">NIS</th>
            <th class="px-4 py-3 border-b">NISN</th>
            <th class="px-4 py-3 border-b">Kelas</th>
            <th class="px-4 py-3 border-b">Jurusan</th>
            <th class="px-4 py-3 border-b">Telepon</th>
            <th class="px-4 py-3 border-b">ID Login</th>
            <th class="px-4 py-3 border-b text-center">Aksi</th>
        </tr>
        </thead>
        <tbody>
        @forelse($siswas as $index => $siswa)
        <tr class="hover:bg-gray-50">
            <td class="px-4 py-3 border-b">{{ $index+1 }}</td>
            <td class="px-4 py-3 border-b">{{ $siswa->nama }}</td>
            <td class="px-4 py-3 border-b">{{ $siswa->nis ?? '-' }}</td>
            <td class="px-4 py-3 border-b">{{ $siswa->nisn ?? '-' }}</td>
            <td class="px-4 py-3 border-b">{{ $siswa->kelas }}</td>
            <td class="px-4 py-3 border-b">{{ $siswa->jurusan }}</td>
            <td class="px-4 py-3 border-b">{{ $siswa->telepon ?? '-' }}</td>
            <td class="px-4 py-3 border-b">{{ $siswa->login->id_login }}</td>
            <td class="px-4 py-3 border-b text-center">
            <div class="flex items-center justify-center gap-2">
                <!-- Edit -->
                <a href="{{ route('admin.siswa.edit', $siswa->id) }}"
                   class="p-2 rounded-lg bg-brand/10 text-brand hover:bg-brand/20" title="Edit">
                  <i class="fas fa-edit"></i>
                </a>
                <!-- Delete -->
                <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit"
                          class="p-2 rounded-lg bg-red-100 text-red-600 hover:bg-red-200"
                          title="Hapus">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>
              </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8" class="px-4 py-6 text-center text-gray-500">
            <i class="fas fa-info-circle"></i> Tidak ada data siswa.
            </td>
        </tr>
        @endforelse
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
