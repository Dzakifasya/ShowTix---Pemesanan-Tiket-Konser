<?php

namespace App\Filament\Resources\Artis;

use App\Filament\Resources\Artis\Pages\CreateArtis;
use App\Filament\Resources\Artis\Pages\EditArtis;
use App\Filament\Resources\Artis\Pages\ListArtis;
use App\Filament\Resources\Artis\Schemas\ArtisForm;
use App\Filament\Resources\Artis\Tables\ArtisTable;
use App\Models\Artis;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ArtisResource extends Resource
{
    protected static ?string $model = Artis::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nama_artis';

    public static function form(Schema $schema): Schema
    {
        return ArtisForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ArtisTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListArtis::route('/'),
            'create' => CreateArtis::route('/create'),
            'edit' => EditArtis::route('/{record}/edit'),
        ];
    }
}
