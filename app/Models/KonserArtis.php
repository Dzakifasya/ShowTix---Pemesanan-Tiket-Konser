<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KonserArtis extends Model
{
    protected $table = 'konser_artis';

    protected $fillable = [
        'konser_id',
        'artis_id',
    ];
}