<?php

namespace App\Filament\Resources\Artis\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ArtisForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_artis')
                    ->required()
                    ->maxLength(255),

                TextInput::make('genre')
                    ->required()
                    ->maxLength(100),

                TextInput::make('negara_asal')
                    ->required()
                    ->maxLength(100),

                Textarea::make('deskripsi')
                    ->rows(4)
                    ->columnSpanFull(),

                FileUpload::make('foto_artis')
                    ->image()
                    ->disk('public')
                    ->directory('foto-artis')
                    ->preserveFilenames(),
            ]);
    }
}