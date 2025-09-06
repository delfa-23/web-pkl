<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Guru | SyifaPKL</title>

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
      <h1 class="text-2xl font-semibold text-brand">
        <i class="fas fa-chalkboard-teacher text-brand"></i> Data Guru
      </h1>
      <a href="{{ route('admin.guru.create') }}"
         class="px-4 py-2 bg-brand text-white rounded-lg shadow hover:bg-brand-dark flex items-center gap-2">
        <i class="fas fa-plus"></i> Tambah Data
      </a>
    </div>

    <!-- Pesan sukses -->
    @if(session('success'))
      <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
        {{ session('success') }}
      </div>
    @endif

    <!-- Search -->
    <div class="mb-4">
        <form action="{{ route('admin.guru.index') }}" method="GET" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Search Data"
                class="w-full md:w-1/3 px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-brand">

            <button type="submit"
                    class="px-4 py-2 bg-brand text-white rounded-lg shadow hover:bg-brand/90 flex items-center gap-2">
            <i class="fas fa-search"></i> Cari
            </button>
        </form>
    </div>

    <!-- Tabel -->
    <div class="overflow-x-auto bg-white rounded-lg shadow">
      <table class="w-full text-left border-collapse">
        <thead class="bg-gray-100 text-brand">
          <tr>
            <th class="px-4 py-3 border-b">No</th>
            <th class="px-4 py-3 border-b">Nama</th>
            <th class="px-4 py-3 border-b">NIP</th>
            <th class="px-4 py-3 border-b">NUPTK</th>
            <th class="px-4 py-3 border-b">Jabatan</th>
            <th class="px-4 py-3 border-b">Dibuat</th>
            <th class="px-4 py-3 border-b text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($guru as $index => $g)
          <tr class="hover:bg-gray-50">
            <td class="px-4 py-3 border-b">{{ $index+1 }}</td>
            <td class="px-4 py-3 border-b">{{ $g->nama }}</td>
            <td class="px-4 py-3 border-b">{{ $g->nip ?? '-' }}</td>
            <td class="px-4 py-3 border-b">{{ $g->nuptk ?? '-' }}</td>
            <td class="px-4 py-3 border-b">{{ $g->jabatan }}</td>
            <td class="px-4 py-3 border-b">{{ $g->created_at->format('d, M Y') }}</td>
            <td class="px-4 py-3 border-b text-center">
              <div class="flex items-center justify-center gap-2">
                <!-- Edit -->
                <a href="{{ route('admin.guru.edit', $g->id) }}"
                   class="p-2 rounded-lg bg-brand/10 text-brand hover:bg-brand/20" title="Edit">
                  <i class="fas fa-edit"></i>
                </a>
                <!-- Delete -->
                <form action="{{ route('admin.guru.destroy', $g->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus?')">
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
            <td colspan="7" class="px-4 py-6 text-center text-gray-500">
              <i class="fas fa-info-circle"></i> Tidak Ada Data
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Tombol kembali -->
    <div class="mt-6">
      <a href="{{ route('admin.dashboard')}}" class="text-brand hover:underline flex items-center gap-2">
        <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
      </a>
    </div>

  </div>
</body>
</html>
