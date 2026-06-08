<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriTiket extends Model
{
    protected $fillable = [
        'konser_id',
        'nama_kategori',
        'harga',
        'kuota',
        'sisa_kuota',
        'deskripsi',
    ];

    public function konser()
    {
        return $this->belongsTo(Konser::class);
    }

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class);
    }
}