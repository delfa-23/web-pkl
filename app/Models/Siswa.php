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
        return $this->belongsTo(Login::class, 'login_id');
    }

    public function tempatPkl()
    {
        return $this->hasOne(TempatPKL::class, 'siswa_id', 'id');
    }

    public function activities()
    {
        return $this->hasMany(DailyActivity::class, 'login_id', 'login_id');
    }
}
