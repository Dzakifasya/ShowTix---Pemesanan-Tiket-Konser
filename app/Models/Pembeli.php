<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pembeli extends Model
{
    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'email',
        'no_whatsapp',
        'no_hp',
        'alamat',
        'jenis_kelamin',
        'provinsi',
        'tanggal_lahir',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function transaksi(): HasMany
    {
        return $this->hasMany(Transaksi::class);
    }
}