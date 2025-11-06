<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tnc extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_snk';
    protected $fillable = ['judul', 'deskripsi'];
}
