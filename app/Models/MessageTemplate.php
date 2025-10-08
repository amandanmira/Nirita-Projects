<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageTemplate extends Model
{
    protected $fillable = ['jenis_template', 'no_telp_tujuan', 'isi'];
}
