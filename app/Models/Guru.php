<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $fillable = ['login_id', 'nama', 'mapel'];

    public function login()
    {
        return $this->belongsTo(Login::class, 'login_id');
    }
}
