<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nip',
        'nuptk',
        'jabatan',
        'login_id',
    ];

    public function login()
    {
        return $this->belongsTo(Login::class, 'login_id');
    }
}
