<?php

namespace App\Filament\Resources\Pembelis\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables;
use Filament\Tables\Table;

class PembelisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('user.name')
            ->label('User'),

                Tables\Columns\TextColumn::make('user.name'),

                Tables\Columns\TextColumn::make('nama_lengkap'),

                Tables\Columns\TextColumn::make('no_hp'),

                Tables\Columns\TextColumn::make('tanggal_lahir'),
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