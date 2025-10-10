<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_nota';
    protected $fillable = [
        'id_mobil', 'nama_penyewa', 'no_hp_penyewa', 'tanggal_sewa',
        'driver', 'deskripsi_kegiatan', 'total_pembayaran'
    ];

    public function car()
    {
        return $this->belongsTo(Car::class, 'id_mobil');
    }
}
