<?php

namespace App\Filament\Resources\Konsers\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class KonserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_konser')
                    ->required()
                    ->maxLength(255),

                Textarea::make('deskripsi')
                    ->rows(4)
                    ->columnSpanFull(),

                DatePicker::make('tanggal_konser')
                    ->required(),

                TimePicker::make('waktu_konser')
                    ->required(),

                TextInput::make('lokasi')
                    ->required()
                    ->maxLength(255),

                FileUpload::make('poster')
                    ->image()
                    ->disk('public')
                    ->directory('poster-konser')
                    ->preserveFilenames(),

                Select::make('status_konser')
                    ->options([
                        'Aktif' => 'Aktif',
                        'Selesai' => 'Selesai',
                        'Dibatalkan' => 'Dibatalkan',
                    ])
                    ->default('Aktif')
                    ->required(),
            ]);
    }
}