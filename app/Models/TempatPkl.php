<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempatPkl extends Model
{
    use HasFactory;

    protected $fillable = ['login_id', 'nama', 'jurusan', 'nama_perusahaan', 'tempat_pkl'];

    public function login()
    {
        return $this->belongsTo(Login::class, 'login_id');
    }
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'login_id', 'login_id');
    }
}
