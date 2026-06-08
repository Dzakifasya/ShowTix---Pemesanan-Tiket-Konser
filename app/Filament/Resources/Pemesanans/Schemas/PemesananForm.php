<?php

namespace App\Filament\Resources\Pemesanans\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PemesananForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('transaksi_id')
                    ->relationship('transaksi', 'kode_transaksi')
                    ->required(),

                Select::make('kategori_tiket_id')
                    ->relationship('kategoriTiket', 'nama_kategori')
                    ->required(),

                TextInput::make('jumlah_tiket')
                    ->numeric()
                    ->required(),

                TextInput::make('harga_satuan')
                    ->numeric()
                    ->required(),

                TextInput::make('subtotal')
                    ->numeric()
                    ->required(),

            ]);
    }
}