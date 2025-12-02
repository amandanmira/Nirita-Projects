<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_nota';
    protected $fillable = [
        'nama_penyewa',
        'no_hp_penyewa',
        'driver',
        'total_pembayaran',
        'lokasi_invoice',
        'tanggal_invoice',
        'perusahaan',
        'catatan',
    ];

    public function billDetails()
    {
        return $this->hasMany(BillDetail::class, 'id_nota', 'id_nota');
    }
}
