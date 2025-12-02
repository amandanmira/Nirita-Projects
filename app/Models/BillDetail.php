<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_nota',
        'id_mobil',
        'tanggal_sewa',
        'lokasi_sewa',
        'tanggal_akhir_sewa',
        'deskripsi_kegiatan',
        'tujuan',
    ];

    public function bills()
    {
        return $this->belongsTo(Bill::class, 'id_nota');
    }

    public function cars()
    {
        return $this->belongsTo(Car::class, 'id_mobil');
    }
}
