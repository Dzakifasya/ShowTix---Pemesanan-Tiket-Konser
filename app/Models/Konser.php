<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Konser extends Model
{
    protected $fillable = [
        'nama_konser',
        'deskripsi',
        'tanggal_konser',
        'waktu_konser',
        'lokasi',
        'poster',
        'status_konser',
    ];

    protected $casts = [
        'tanggal_konser' => 'date',
        'waktu_konser' => 'datetime',
    ];

    public function artis()
    {
        return $this->belongsToMany(
            Artis::class,
            'konser_artis'
        );
    }

    public function kategoriTiket()
    {
        return $this->hasMany(KategoriTiket::class);
    }

    public function pemesanan(): HasManyThrough
    {
        return $this->hasManyThrough(
            Pemesanan::class,
            KategoriTiket::class,
            'konser_id',
            'kategori_tiket_id'
        );
    }
}