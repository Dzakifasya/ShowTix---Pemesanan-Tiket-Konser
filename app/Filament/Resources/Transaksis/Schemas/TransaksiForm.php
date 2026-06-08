<?php

namespace App\Filament\Resources\Transaksis\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TransaksiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('pembeli_id')
                    ->relationship('pembeli', 'nama_lengkap')
                    ->required(),

                TextInput::make('kode_transaksi')
                    ->required(),

                DatePicker::make('tanggal_transaksi')
                    ->required()
                    ->default(now()),

                TextInput::make('total_harga')
                    ->numeric()
                    ->required(),

                Select::make('status_transaksi')
                    ->options([
                        'Pending' => 'Pending',
                        'Berhasil' => 'Berhasil',
                        'Dibatalkan' => 'Dibatalkan',
                    ])
                    ->required(),
            ]);
    }
}