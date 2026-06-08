<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}