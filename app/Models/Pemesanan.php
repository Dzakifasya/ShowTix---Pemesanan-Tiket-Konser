<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $table = 'pemesanan';

    protected $fillable = [
        'user_id',
        'tiket_id',
        'jumlah',
        'total_harga',
        'tanggal_pemesanan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tiket()
    {
        return $this->belongsTo(Tiket::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }
}
