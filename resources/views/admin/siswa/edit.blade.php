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
        input {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.3s;
        }
        input:focus {
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

            <label>ID Login:</label>
            <input type="text" name="login_id" value="{{ $siswa->login->login_id }}" required>

            <label>Password (Kosongkan jika tidak ingin diubah):</label>
            <input type="password" name="password" placeholder="Password baru">

            <label>Nama:</label>
            <input type="text" name="nama" value="{{ $siswa->nama }}" required>

            <label>Kelas:</label>
            <input type="text" name="kelas" value="{{ $siswa->kelas }}" required>

            <label>Jurusan:</label>
            <input type="text" name="jurusan" value="{{ $siswa->jurusan }}" required>

            <button type="submit" class="btn-submit">Update</button>
        </form>

        <a href="{{ route('admin.siswa.index') }}" class="btn-back">Kembali</a>
    </div>
</body>
</html>
