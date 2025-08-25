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

            <label>Kelas:</label>
            <select name="kelas" required>
                <option value="">-- Pilih Kelas --</option>
                <option value="XI - RPL" {{ $siswa->kelas == 'XI - RPL' ? 'selected' : '' }}>XI - RPL</option>
                <option value="XI - DKV" {{ $siswa->kelas == 'XI - DKV' ? 'selected' : '' }}>XI - DKV</option>
            </select>

            <label>Jurusan:</label>
            <select name="jurusan" required>
                <option value="">-- Pilih Jurusan --</option>
                <option value="RPL" {{ $siswa->jurusan == 'RPL' ? 'selected' : '' }}>RPL</option>
                <option value="TKJ" {{ $siswa->jurusan == 'DKV' ? 'selected' : '' }}>DKV</option>
            </select>

            <label>No Telepon:</label>
            <input type="text" name="telepon" value="{{ $siswa->telepon }}">

            <label>Alamat:</label>
            <textarea name="alamat">{{ $siswa->alamat }}</textarea>

            <label>Tempat Lahir:</label>
            <input type="text" name="tempat_lahir" value="{{ $siswa->tempat_lahir }}">

            <label>Tanggal Lahir:</label>
            <input type="date" name="tanggal_lahir" value="{{ $siswa->tanggal_lahir }}">

            <label>Nama Orang Tua/Wali:</label>
            <input type="text" name="nama_orangtua" value="{{ $siswa->nama_orangtua }}">

            <label>No Telepon Orang Tua:</label>
            <input type="text" name="telepon_orangtua" value="{{ $siswa->telepon_orangtua }}">

            <button type="submit" class="btn-submit">Update</button>
        </form>

        <a href="{{ route('admin.siswa.index') }}" class="btn-back">Kembali</a>
    </div>
</body>
</html>
