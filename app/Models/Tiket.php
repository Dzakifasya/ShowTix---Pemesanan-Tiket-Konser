<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    protected $table = 'tiket';

    protected $fillable = [
        'kategori_tiket_id',
        'stok'
    ];

    public function kategoriTiket()
    {
        return $this->belongsTo(KategoriTiket::class);
    }

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class);
    }
}
