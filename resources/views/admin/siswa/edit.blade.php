
<!DOCTYPE html>
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
</html>
