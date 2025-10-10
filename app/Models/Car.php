<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_mobil';
    protected $fillable = ['nama_mobil', 'url_foto_mobil', 'plat_nomor', 'ketersediaan', 'deskripsi'];

    public function specification()
    {
        return $this->hasOne(Specification::class, 'id_mobil');
    }

    public function rentalPrice()
    {
        return $this->hasOne(RentalPrice::class, 'id_mobil');
    }

    public function bill()
    {
        return $this->hasMany(Bill::class, 'id_mobil');
    }
}
