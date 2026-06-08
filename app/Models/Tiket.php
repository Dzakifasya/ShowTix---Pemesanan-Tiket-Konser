<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    protected $fillable = [
        'pemesanan_id',
        'kode_tiket',
        'qr_code',
        'status_tiket',
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }
}