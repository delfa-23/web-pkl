<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyActivity extends Model
{
    use HasFactory;
    protected $fillable = ['login_id', 'tanggal', 'kegiatan'];

    public function login()
    {
        return $this->belongsTo(Login::class, 'login_id');
    }
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'login_id', 'login_id');
    }
}
