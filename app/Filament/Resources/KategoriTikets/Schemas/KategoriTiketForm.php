<?php

namespace App\Filament\Resources\KategoriTikets\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class KategoriTiketForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('konser_id')
                    ->relationship('konser', 'nama_konser')
                    ->required(),

                Select::make('nama_kategori')
                    ->options([
                        'VIP' => 'VIP',
                        'Reguler' => 'Reguler',
                    ])
                    ->required(),

                TextInput::make('harga')
                    ->numeric()
                    ->required(),

                TextInput::make('kuota')
                    ->numeric()
                    ->required(),

                TextInput::make('sisa_kuota')
                    ->numeric()
                    ->required(),

                Textarea::make('deskripsi'),
            ]);
    }
}