
    <div class="container">
        <h2 class="mb-3">Surat Persetujuan Orang Tua</h2>

        <div class="card p-4">
            <p>Yang bertanda tangan di bawah ini adalah orang tua/wali dari:</p>

            <table class="table table-borderless">
                <tr>
                    <th>Nama Siswa</th>
                    <td>: {{ $siswa->nama }}</td>
                </tr>
                <tr>
                    <th>Tempat/Tanggal Lahir</th>
                    <td>: {{ $siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>: {{ $siswa->jenis_kelamin ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Sekolah</th>
                    <td>: SMK As-Syifa Subang</td>
                </tr>
                <tr>
                    <th>Jurusan</th>
                    <td>: {{ $siswa->jurusan }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>: {{ $siswa->alamat }}</td>
                </tr>
            </table>

            <p>
                Dengan ini menyatakan bahwa saya menyetujui anak saya untuk mengikuti Program Magang/Merdeka Belajar
                yang diselenggarakan oleh pihak terkait, serta bersedia ditempatkan pada mitra penerima magang sesuai
                dengan kriteria dan persyaratan yang berlaku.
            </p>

            <p>
                Demikian surat persetujuan ini saya buat dengan sebenar-benarnya, dalam keadaan sadar, tanpa adanya
                paksaan dari pihak manapun.
            </p>

            <br><br>
            <p style="text-align: right;">
                Subang, ...................... 20..... <br>
                Orang Tua/Wali,
            </p>
            <br><br><br>
            <p style="text-align: right;">
                (.............................................)
            </p>
        </div>

        <br>
        <a href="{{ route('surat.download', ['type' => 'izin', 'id' => $siswa->id]) }}" class="btn btn-success">
            Download PDF
        </a>
        <a href="{{ route('surat.daftar_siswa') }}" class="btn btn-secondary">
            Kembali
        </a>
    </div>
