<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Siswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-800">
  <div class="container mx-auto p-6 max-w-lg">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-semibold text-[#1d9a96]">
        <i class="fas fa-user-edit"></i> Edit Data Siswa
      </h1>
      <a href="{{ route('admin.siswa.index') }}"
         class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg shadow hover:bg-gray-300 flex items-center gap-2">
        <i class="fas fa-times"></i> Batal
      </a>
    </div>

    <!-- Card Form -->
    <div class="bg-white p-6 rounded-lg shadow">
      <form action="{{ route('admin.siswa.update', $siswa->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
          <label class="block font-medium">Nama Lengkap</label>
          <input type="text" name="nama" value="{{ $siswa->nama }}" required
                 class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]">
        </div>

        <div>
          <label class="block font-medium">NIS</label>
          <input type="text" name="nis" value="{{ $siswa->nis }}"
                 class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]">
        </div>

        <div>
          <label class="block font-medium">NISN</label>
          <input type="text" name="nisn" value="{{ $siswa->nisn }}"
                 class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]">
        </div>

        <div>
            <label class="block font-medium">ID Login <span class="text-sm text-gray-500">(kosongkan jika tidak diubah)</span></label>
            <input type="text" name="login_id" value="{{ $siswa->login->id_login }}"
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]">
        </div>

        <div>
            <label class="block font-medium">Password <span class="text-sm text-gray-500">(kosongkan jika tidak diubah)</span></label>
            <input type="password" name="password"
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]">
        </div>

        <div>
            <label class="block font-medium">Kelas</label>
            <select name="kelas" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]">
                <option value="">-- Pilih Kelas --</option>
                <option value="XI - RPL" {{ $siswa->kelas == 'XI - RPL' ? 'selected' : '' }}>XI - RPL</option>
                <option value="XI - DKV" {{ $siswa->kelas == 'XI - DKV' ? 'selected' : '' }}>XI - DKV</option>
            </select>
            </div>

            <div>
            <label class="block font-medium">Jurusan</label>
            <select name="jurusan" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]">
                <option value="">-- Pilih Jurusan --</option>
                <option value="RPL" {{ $siswa->jurusan == 'RPL' ? 'selected' : '' }}>RPL</option>
                <option value="DKV" {{ $siswa->jurusan == 'DKV' ? 'selected' : '' }}>DKV</option>
            </select>
        </div>

        <div>
            <label class="block font-medium">No. Telepon</label>
            <input type="text" name="telepon" value="{{ $siswa->telepon }}"
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]">
        </div>

        <div>
        <label class="block font-medium">Alamat</label>
        <textarea name="alamat"
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]">{{ $siswa->alamat }}</textarea>
        </div>

        <div>
            <label class="block font-medium">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" value="{{ $siswa->tempat_lahir }}"
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]">
        </div>

        <div>
            <label class="block font-medium">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" value="{{ $siswa->tanggal_lahir }}"
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]">
        </div>

        <div>
            <label class="block font-medium">Nama Orang Tua/Wali</label>
            <input type="text" name="nama_orangtua" value="{{ $siswa->nama_orangtua }}"
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]">
        </div>

        <div>
            <label class="block font-medium">No. Telepon Orang Tua</label>
            <input type="text" name="telepon_orangtua" value="{{ $siswa->telepon_orangtua }}"
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1d9a96]">
        </div>

        <div class="flex justify-end gap-3">
          <button type="reset"
                  class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
            <i class="fas fa-undo"></i> Reset
          </button>
          <button type="submit"
                  class="px-4 py-2 bg-[#1d9a96] text-white rounded-lg shadow hover:bg-[#17807c]">
            <i class="fas fa-save"></i> Update
          </button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>










{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 500px;
            margin: 40px auto;
            background-color: white;
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0px 3px 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #1d9a96;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 6px;
            color: #333;
            font-weight: bold;
        }
        input, select, textarea {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.3s;
        }
        input:focus, select:focus, textarea:focus {
            border-color: #1d9a96;
            outline: none;
            box-shadow: 0px 0px 5px rgba(29,154,150,0.3);
        }
        .btn-submit {
            width: 100%;
            background-color: #1d9a96;
            color: white;
            border: none;
            padding: 10px;
            font-size: 15px;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn-submit:hover {
            background-color: #157a77;
        }
        .btn-back {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 14px;
            background-color: #d5ad71;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            transition: 0.3s;
        }
        .btn-back:hover {
            background-color: #b89055;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Siswa</h1>

        <form action="{{ route('admin.siswa.update', $siswa->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Nama Lengkap:</label>
            <input type="text" name="nama" value="{{ $siswa->nama }}" required>

            <label>NIS:</label>
            <input type="text" name="nis" value="{{ $siswa->nis }}">

            <label>NISN:</label>
            <input type="text" name="nisn" value="{{ $siswa->nisn }}">

            <label>ID Login:</label>
            <input type="text" name="id_login" value="{{ $siswa->login->id_login }}" required>

            <label>Password (Kosongkan jika tidak ingin diubah):</label>
            <input type="password" name="password" placeholder="Password baru">

            <div>
  <label class="block text-sm font-medium">Kelas</label>
  <select name="kelas" id="kelas" class="w-full border rounded-lg px-3 py-2" required>
      <option value="XI - RPL" {{ $siswa->kelas == 'XI - RPL' ? 'selected' : '' }}>XI - RPL</option>
      <option value="XI - DKV" {{ $siswa->kelas == 'XI - DKV' ? 'selected' : '' }}>XI - DKV</option>
  </select>
</div>

<input type="hidden" name="jurusan" id="jurusan" value="{{ $siswa->jurusan }}">


            <label>No Telepon:</label>
            <input type="text" name="telepon" value="{{ $siswa->telepon }}">

            <label>Alamat:</label>
            <textarea name="alamat">{{ $siswa->alamat }}</textarea>

            <label>Tempat Lahir:</label>
            <input type="text" name="tempat_lahir" value="{{ $siswa->tempat_lahir }}">

            <label>Tanggal Lahir:</label>
            <input type="date" name="tanggal_lahir" value="{{ $siswa->tanggal_lahir }}">

            <label>Status Siswa:</label>
            <select name="status" required>
                <option value="Aktif" {{ $siswa->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="Nonaktif" {{ $siswa->status == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
            </select>

            <label>Nama Orang Tua/Wali:</label>
            <input type="text" name="nama_orangtua" value="{{ $siswa->nama_orangtua }}">

            <label>No Telepon Orang Tua:</label>
            <input type="text" name="telepon_orangtua" value="{{ $siswa->telepon_orangtua }}">

            <button type="submit" class="btn-submit">Update</button>
        </form>

        <a href="{{ route('admin.siswa.index') }}" class="btn-back">Kembali</a>
    </div>
    <script>
  function setJurusan(val) {
      let jurusanInput = document.getElementById("jurusan");
      if (val === "XI - RPL") {
          jurusanInput.value = "RPL";
      } else if (val === "XI - DKV") {
          jurusanInput.value = "DKV";
      } else {
          jurusanInput.value = "";
      }
  }

  let kelasSelect = document.getElementById("kelas");
  kelasSelect.addEventListener("change", function() {
      setJurusan(this.value);
  });

  // jalanin sekali waktu load halaman edit
  setJurusan(kelasSelect.value);
</script>

</body>
</html> --}}
