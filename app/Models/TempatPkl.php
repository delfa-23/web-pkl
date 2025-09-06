<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempatPkl extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'nama_perusahaan',
        'alamat_perusahaan',
        'telepon_perusahaan',
        'pembimbing_perusahaan',
        'status',
    ];

    public function login()
    {
        return $this->belongsTo(Login::class, 'login_id');
    }
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }
    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'belum_terverifikasi' => 'Belum Terverifikasi',
            'proses' => 'Proses',
            'diterima' => 'Diterima',
            'ditolak' => 'Ditolak',
            default => $this->status,
        };
    }

}
