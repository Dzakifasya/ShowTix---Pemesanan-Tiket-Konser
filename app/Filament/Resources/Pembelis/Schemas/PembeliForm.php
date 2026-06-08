<?php

namespace App\Filament\Resources\Pembelis\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PembeliForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('nama_lengkap')
                    ->required(),

                TextInput::make('no_hp')
                    ->required(),

                Textarea::make('alamat')
                    ->required(),

                DatePicker::make('tanggal_lahir')
                    ->required(),

            ]);
    }
}