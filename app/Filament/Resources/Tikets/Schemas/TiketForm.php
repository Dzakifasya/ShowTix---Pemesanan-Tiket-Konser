<?php

namespace App\Filament\Resources\Tikets\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TiketForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('pemesanan_id')
                    ->relationship('pemesanan', 'id')
                    ->required(),

                TextInput::make('kode_tiket')
                    ->required(),

                TextInput::make('qr_code'),

                Select::make('status_tiket')
                    ->options([
                        'Aktif'=>'Aktif',
                        'Digunakan'=>'Digunakan',
                        'Kadaluarsa'=>'Kadaluarsa',
                    ]),
            ]);
    }
}