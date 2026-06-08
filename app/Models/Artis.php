<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artis extends Model
{
    protected $table = 'artis';

    protected $fillable = [
        'nama_artis',
        'genre',
        'negara_asal',
        'deskripsi',
        'foto_artis',
    ];

    public function konser()
    {
        return $this->belongsToMany(
            Konser::class,
            'konser_artis'
        );
    }
}