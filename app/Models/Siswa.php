<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswas';

    protected $fillable = [
        'login_id',
        'nama',
        'nis',
        'nisn',
        'telepon',
        'kelas',
        'jurusan',
        'status',
        'kehadiran',
        'nama_orangtua',
        'telepon_orangtua',
        'alamat',
        'tempat_lahir',
        'tanggal_lahir',
    ];

    public function login()
    {
        return $this->belongsTo(Login::class, 'login_id', 'id');
    }

    public function tempatPkl()
    {
        return $this->hasOne(TempatPKL::class, 'siswa_id', 'id');
    }

    public function tempats()
    {
        return $this->belongsToMany(TempatPkl::class, 'siswa_tempat', 'siswa_id', 'tempat_pkl_id')
            ->withPivot('status', 'jurusan')
            ->withTimestamps();
    }

    public function tempatAktif()
    {
        return $this->tempats()
            ->wherePivotIn('status', ['proses', 'diterima'])
            ->first();
    }

    public function tempat()
    {
        return $this->hasOne(TempatPkl::class, 'siswa_id');
    }

    public function activities()
    {
        return $this->hasMany(DailyActivity::class, 'login_id', 'login_id');
    }

    public function guru()
    {
        return $this->hasOneThrough(
            Guru::class,      // model tujuan
            TempatPkl::class, // model perantara
            'id',             // foreign key TempatPkl di tabel `tempat_pkls`
            'id',             // foreign key Guru
            'id',             // local key Siswa
            'guru_id'         // key guru di TempatPkl
        );
    }
}
