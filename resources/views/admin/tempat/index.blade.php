<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Tempat PKL | SyifaPKL</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

  <style>
    .text-brand { color: #1d9a96; }
    .bg-brand { background-color: #1d9a96; }
    .bg-brand:hover { background-color: #17807c; }
  </style>
</head>
<body class="bg-light">
  <div class="container py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="text-brand">
        <i class="fas fa-building"></i> Data Tempat PKL
      </h2>
      <a href="{{ route('admin.dashboard') }}" class="btn bg-brand text-white">
        <i class="fas fa-arrow-left me-2"></i>Kembali
      </a>
    </div>

    <!-- Pesan sukses -->
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Search -->
    <form action="{{ route('admin.tempat.index') }}" method="GET" class="row g-2 mb-3">
      <div class="col-md-4">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
               placeholder="Cari siswa / perusahaan...">
      </div>
      <div class="col-auto">
        <button type="submit" class="btn bg-brand text-white">
          <i class="fas fa-search"></i> Cari
        </button>
      </div>
    </form>

    <!-- Table -->
    <div class="table-responsive bg-white shadow rounded">
      <table class="table table-striped align-middle mb-0">
        <thead class="table-light text-brand">
          <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Jurusan</th>
            <th>Perusahaan</th>
            <th>Alamat</th>
            <th>Status</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($tempats as $index => $tempat)
          <tr>
            <td>{{ $index+1 }}</td>
            <td>
                @foreach($tempat->siswas as $siswa)
                    <li>{{ $siswa->nama }}</li>
                @endforeach
            </td>
            <td>
                <ul style="padding-left:15px; margin:0;">
                    @foreach($tempat->siswas as $anggota)
                        <li>{{ $anggota->jurusan }}</li>
                    @endforeach
                </ul>
            </td>
            <td>{{ $tempat->nama_perusahaan }}</td>
            <td>{{ $tempat->alamat_perusahaan }}</td>
            <td>
                {{-- Status warna --}}
              @if($tempat->status == 'belum_terverifikasi')
                <span class="badge bg-secondary">Belum Terverifikasi</span>
              @elseif($tempat->status == 'proses')
                <span class="badge bg-warning text-dark">Proses</span>
              @elseif($tempat->status == 'diterima')
                <span class="badge bg-success">Diterima</span>
              @elseif($tempat->status == 'ditolak')
                <span class="badge bg-danger">Ditolak</span>
              @endif
            </td>
            <td>
                {{-- Dropdown khusus admin --}}
                @if(session('role') == 'admin')
                    <form action="{{ route('admin.tempat.update', $tempat->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT')
                        <select name="status" onchange="this.form.submit()">
                            <option value="belum_terverifikasi" {{ $tempat->status == 'belum_terverifikasi' ? 'selected' : '' }}>Belum Terverifikasi</option>
                            <option value="proses" {{ $tempat->status == 'proses' ? 'selected' : '' }}>Proses</option>
                            <option value="diterima" {{ $tempat->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                            <option value="ditolak" {{ $tempat->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </form>
                @endif

                {{-- Tombol edit data perusahaan --}}
                <a href="{{ session('role') == 'admin'
                            ? route('siswa.tempat.edit', $tempat->id)
                            : route('siswa.tempat.edit', $tempat->id) }}"
                   style="margin-left:5px; color: blue; text-decoration: underline;">
                    Edit
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($tempats as $index => $tempat)
          <tr>
            <td>{{ $index+1 }}</td>
            <td>{{ $tempat->siswa->nama }}</td>
            <td>{{ $tempat->siswa->jurusan }}</td>
            <td>{{ $tempat->nama_perusahaan }}</td>
            <td>{{ $tempat->alamat_perusahaan }}</td>
            <td>
              @if($tempat->status == 'belum_terverifikasi')
                <span class="badge bg-secondary">Belum Terverifikasi</span>
              @elseif($tempat->status == 'proses')
                <span class="badge bg-warning text-dark">Proses</span>
              @elseif($tempat->status == 'diterima')
                <span class="badge bg-success">Diterima</span>
              @elseif($tempat->status == 'ditolak')
                <span class="badge bg-danger">Ditolak</span>
              @endif
            </td>
            <td class="text-center">
              <!-- Update status -->
              <form action="{{ route('admin.tempat.update', $tempat->id) }}" method="POST" class="d-inline">
                @csrf
                @method('PUT')
                <select name="status" class="form-select form-select-sm d-inline w-auto"
                        onchange="this.form.submit()">
                  <option value="belum_terverifikasi" {{ $tempat->status == 'belum_terverifikasi' ? 'selected' : '' }}>Belum Terverifikasi</option>
                  <option value="proses" {{ $tempat->status == 'proses' ? 'selected' : '' }}>Proses</option>
                  <option value="diterima" {{ $tempat->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                  <option value="ditolak" {{ $tempat->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
              </form>

              <!-- Edit trigger -->
              <button class="btn btn-sm btn-outline-brand ms-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $tempat->id }}">
                <i class="fas fa-edit text-brand"></i>
              </button>
            </td>
          </tr>

          <!-- Modal Edit -->
          <div class="modal fade" id="editModal{{ $tempat->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title text-brand">Edit Tempat PKL</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('siswa.tempat.update', $tempat->id) }}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="modal-body">
                    <div class="mb-3">
                      <label class="form-label">Nama Perusahaan</label>
                      <input type="text" name="nama_perusahaan" value="{{ $tempat->nama_perusahaan }}" class="form-control">
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Alamat Perusahaan</label>
                      <textarea name="alamat_perusahaan" class="form-control">{{ $tempat->alamat_perusahaan }}</textarea>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">No. Telp Perusahaan</label>
                      <input type="text" name="no_telp_perusahaan" value="{{ $tempat->telepon_perusahaan }}" class="form-control">
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Pembimbing Perusahaan</label>
                      <input type="text" name="pembimbing_perusahaan" value="{{ $tempat->pembimbing_perusahaan }}" class="form-control">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn bg-brand text-white"><i class="fas fa-save"></i> Simpan</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          @empty
          <tr>
            <td colspan="7" class="text-center text-muted py-4">
              <i class="fas fa-info-circle"></i> Tidak Ada Data
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Tombol kembali -->
    <div class="mt-4">
      <a href="{{ route('admin.dashboard')}}" class="text-brand text-decoration-none">
        <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
      </a>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
