<h2>Data Tempat PKL</h2>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>Nama Siswa</th>
            <th>Jurusan</th>
            <th>Perusahaan</th>
            <th>Alamat</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tempats as $tempat)
        <tr>
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
                    <span style="color: gray">Belum Terverifikasi</span>
                @elseif($tempat->status == 'proses')
                    <span style="color: orange">Proses</span>
                @elseif($tempat->status == 'diterima')
                    <span style="color: green">Diterima</span>
                @elseif($tempat->status == 'ditolak')
                    <span style="color: red">Ditolak</span>
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

<a href="{{ route('admin.dashboard')}}">Back</a>
