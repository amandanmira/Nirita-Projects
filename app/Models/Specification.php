<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_spesifikasi';
    protected $fillable = ['id_mobil', 'jenis_transmisi', 'kapasitas', 'jenis_bbm'];

    public function car()
    {
        return $this->belongsTo(Car::class, 'id_mobil');
    }
}
