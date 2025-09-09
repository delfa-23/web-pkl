<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_login',
        'password',
        'role'
    ];
    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'login_id', 'id');
    }
}
