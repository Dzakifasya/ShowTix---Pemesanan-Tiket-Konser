<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $fillable = [
        'transaksi_id',
        'kategori_tiket_id',
        'jumlah_tiket',
        'harga_satuan',
        'subtotal',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function kategoriTiket()
    {
        return $this->belongsTo(
            KategoriTiket::class,
            'kategori_tiket_id'
        );
    }

    public function tiket()
    {
        return $this->hasMany(Tiket::class);
    }
}