<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Tempat PKL</title>
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
        h2 {
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
        input, textarea {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.3s;
        }
        input:focus, textarea:focus {
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
        <h2>Input Tempat PKL</h2>

        <form method="POST" action="{{ route('siswa.tempat.store') }}">
            @csrf

            <label>Nama Perusahaan:</label>
            <input type="text" name="nama_perusahaan" required>

            <label>Alamat Perusahaan:</label>
            <textarea name="alamat_perusahaan" required></textarea>

            <label>Telepon Perusahaan:</label>
            <input type="text" name="telepon_perusahaan">

            <label>Pembimbing Perusahaan:</label>
            <input type="text" name="pembimbing_perusahaan">

            <button type="submit" class="btn-submit">Simpan</button>
        </form>

        <a href="{{ route('siswa.dashboard') }}" class="btn-back">Kembali</a>
    </div>
</body>
</html>
