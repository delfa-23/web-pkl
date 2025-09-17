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
        .btn-outline-brand { border: 1px solid #1d9a96; color: #1d9a96; }
        .btn-outline-brand:hover { background: #1d9a96; color: #fff; }
    </style>
</head>
<body class="bg-light">
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-brand"><i class="fas fa-building"></i> Data Tempat PKL</h2>
        <a href="{{ route('admin.dashboard') }}" class="btn bg-brand text-white">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

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
                <th>No. Telp</th>
                <th>Status</th>
                <th class="text-center">Aksi</th>
            </tr>
            </thead>
            <tbody>
            @forelse($tempats as $index => $tempat)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        @foreach($tempat->siswas as $siswa)
                            <div>{{ $siswa->nama }}</div>
                        @endforeach
                    </td>
                    <td>
                        @foreach($tempat->siswas as $siswa)
                            <div>{{ $siswa->jurusan }}</div>
                        @endforeach
                    </td>

                    <td>{{ $tempat->nama_perusahaan }}</td>
                    <td>{{ $tempat->alamat_perusahaan }}</td>
                    <td>{{ $tempat->telepon_perusahaan ?? '-' }}</td>
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
                        <a href="{{ route('siswa.tempat.edit', $tempat->id) }}"
                        class="btn btn-sm btn-outline-brand ms-2">
                            <i class="fas fa-edit text-brand"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4"><i class="fas fa-info-circle"></i> Tidak Ada Data</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
