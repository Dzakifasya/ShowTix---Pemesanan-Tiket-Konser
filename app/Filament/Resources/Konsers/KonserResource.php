<?php

namespace App\Filament\Resources\Konsers;

use App\Filament\Resources\Konsers\Pages\CreateKonser;
use App\Filament\Resources\Konsers\Pages\EditKonser;
use App\Filament\Resources\Konsers\Pages\ListKonsers;
use App\Filament\Resources\Konsers\Schemas\KonserForm;
use App\Filament\Resources\Konsers\Tables\KonsersTable;
use App\Models\Konser;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class KonserResource extends Resource
{
    protected static ?string $model = Konser::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nama_konser';

    
    
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return KonserForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KonsersTable::configure($table);
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
            'index' => ListKonsers::route('/'),
            'create' => CreateKonser::route('/create'),
            'edit' => EditKonser::route('/{record}/edit'),
        ];
    }

        public static function canViewAny(): bool
    {
        return auth()->user()->hasRole('Admin');
    }
}
