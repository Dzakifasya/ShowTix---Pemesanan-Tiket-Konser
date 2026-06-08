<?php

namespace App\Filament\Resources\KategoriTikets\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables;
use Filament\Tables\Table;

class KategoriTiketsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('konser.nama_konser')
                    ->label('Konser'),

                Tables\Columns\TextColumn::make('nama_kategori'),

                Tables\Columns\TextColumn::make('harga')
                    ->money('IDR'),

                Tables\Columns\TextColumn::make('kuota'),

                Tables\Columns\TextColumn::make('sisa_kuota'),

            ])
           ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}