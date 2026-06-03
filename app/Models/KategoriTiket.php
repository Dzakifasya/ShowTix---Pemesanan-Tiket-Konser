<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriTiket extends Model
{
    protected $table = 'kategori_tiket';

    protected $fillable = [
        'konser_id',
        'nama_kategori',
        'harga'
    ];

    public function konser()
    {
        return $this->belongsTo(Konser::class);
    }

    public function tiket()
    {
        return $this->hasMany(Tiket::class);
    }
}
