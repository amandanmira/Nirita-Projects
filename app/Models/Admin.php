<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id_admin';
    protected $fillable = ['nama_lengkap', 'username', 'email', 'password'];
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
