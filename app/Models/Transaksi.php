<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'pembeli_id',
        'kode_transaksi',
        'tanggal_transaksi',
        'total_harga',
        'status_transaksi',
    ];

    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class);
    }
}