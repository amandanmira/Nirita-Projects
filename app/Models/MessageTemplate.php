<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageTemplate extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id_template';
    protected $fillable = ['jenis_template', 'no_telp_tujuan', 'isi'];
}
