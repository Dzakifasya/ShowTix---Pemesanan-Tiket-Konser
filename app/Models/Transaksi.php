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
        'expired_at',
    ];

    protected $casts = [
        'tanggal_transaksi' => 'datetime',
        'expired_at' => 'datetime',
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