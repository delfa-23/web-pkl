<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | SyifaPkl</title>
    <link rel="stylesheet" href="{{ asset('storage/assets/css/admin.css') }}">
</head>
<body>
    <div class="sidebar">
    <h4>SYIFAPKL</h4>
    <hr style="border-color: white;">
    <a href="{{ route('admin.dashboard') }}">🏠 Dashboard</a>
    <a href="{{ route('admin.guru.index') }}">📚 Kelola Data Guru</a>
    <a href="{{ route('admin.siswa.index') }}">👨‍🎓 Kelola Data Siswa</a>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
  </div>

  <div class="content">
    <h2>Selamat Datang, Admin</h2>
    <p>Gunakan menu di samping untuk mengelola data sistem PKL.</p>
    <div class="row mt-4">
      <div class="col-md-4">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Jumlah Guru</h5>
            <p class="card-text">{{ $jumlahGuru }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Jumlah Siswa</h5>
            <p class="card-text">{{ $jumlahSiswa }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

