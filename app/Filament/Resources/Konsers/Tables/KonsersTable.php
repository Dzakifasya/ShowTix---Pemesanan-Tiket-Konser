<?php

namespace App\Filament\Resources\Konsers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class KonsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_konser')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('tanggal_konser')
                    ->date()
                    ->sortable(),

                TextColumn::make('waktu_konser')
                    ->sortable(),

                TextColumn::make('lokasi')
                    ->searchable()
                    ->limit(30),

                TextColumn::make('status_konser')
                    ->badge(),

                ImageColumn::make('poster')
                    ->disk('public'),

                TextColumn::make('created_at')
                    ->dateTime('d M Y'),
            ])
            ->filters([
                //
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
