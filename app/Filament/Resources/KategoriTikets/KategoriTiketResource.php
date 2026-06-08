<?php

namespace App\Filament\Resources\KategoriTikets;

use App\Filament\Resources\KategoriTikets\Pages\CreateKategoriTiket;
use App\Filament\Resources\KategoriTikets\Pages\EditKategoriTiket;
use App\Filament\Resources\KategoriTikets\Pages\ListKategoriTikets;
use App\Filament\Resources\KategoriTikets\Schemas\KategoriTiketForm;
use App\Filament\Resources\KategoriTikets\Tables\KategoriTiketsTable;
use App\Models\KategoriTiket;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class KategoriTiketResource extends Resource
{
    protected static ?string $model = KategoriTiket::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nama_kategori';

    public static function form(Schema $schema): Schema
    {
        return KategoriTiketForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KategoriTiketsTable::configure($table);
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
            'index' => ListKategoriTikets::route('/'),
            'create' => CreateKategoriTiket::route('/create'),
            'edit' => EditKategoriTiket::route('/{record}/edit'),
        ];
    }
}
