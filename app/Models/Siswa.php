<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswas';

    public function login()
    {
        return $this->belongsTo(Login::class, 'login_id', 'id');
    }

    protected $fillable = [
        'login_id',
        'nama',
        'nis',
        'nisn',
        'password',
        'kelas',
        'jurusan',
        'telepon',
        'alamat',
        'tempat_lahir',
        'tanggal_lahir',
        'nama_orangtua',
        'telepon_orangtua',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    // relasi ke tabel pivot siswa_tempat
    public function tempats()
    {
        return $this->belongsToMany(
            TempatPkl::class,
            'siswa_tempat',
            'siswa_id',
            'tempat_pkl_id'
        )->withPivot('status');
    }

    // tempat PKL yang aktif
    public function tempatAktif()
    {
        return $this->tempats()
            ->wherePivotIn('status', ['proses', 'diterima']);
    }

    public function activities()
    {
        return $this->hasMany(DailyActivity::class, 'login_id', 'login_id');
    }

    public function getGuruAttribute()
    {
        return optional($this->tempatAktif->first())->guru;
    }
}
