<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Aktivitas Harian | SyifaPKL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-4">
        <h2 class="mb-4">Tambah Aktivitas Harian</h2>

        <form action="{{ route('siswa.activity.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-4 rounded shadow">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal & Waktu</label>
                <input type="datetime-local" name="tanggal" id="tanggal" value="{{ old('tanggal') }}"
                    class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="kegiatan" class="form-label">Kegiatan</label>
                <textarea name="kegiatan" id="kegiatan" class="form-control" rows="3" required>{{ old('kegiatan') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Foto (Wajib)</label>
                <input type="file" name="foto" id="foto" class="form-control" accept="image/*" required>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('siswa.activity.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>

</html>
