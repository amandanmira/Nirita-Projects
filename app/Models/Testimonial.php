<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_testimoni';
    protected $fillable = ['url_gambar', 'desk_testimoni'];

    // Jika kamu ingin route model binding memakai id_testimoni
    public function getRouteKeyName()
    {
        return $this->primaryKey; // => 'id_testimoni'
    }
}
