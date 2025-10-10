<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalPrice extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_harga';
    protected $fillable = ['id_mobil', 'harga_solo', 'harga_solo_raya', 'harga_luar_kota'];

    public function car()
    {
        return $this->belongsTo(Car::class, 'id_mobil');
    }
}
