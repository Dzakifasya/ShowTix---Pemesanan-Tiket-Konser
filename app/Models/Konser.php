<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Konser extends Model
{
    protected $table = 'konser';

    protected $fillable = [
        'nama_konser',
        'artis',
        'lokasi',
        'tanggal_konser'
    ];

    public function kategoriTiket()
    {
        return $this->hasMany(KategoriTiket::class);
    }
}

