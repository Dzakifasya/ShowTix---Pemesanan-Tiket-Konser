<?php

namespace App\Filament\Resources\Transaksis\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables;
use Filament\Tables\Table;

class TransaksisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('kode_transaksi'),

                Tables\Columns\TextColumn::make('pembeli.nama_lengkap'),

                Tables\Columns\TextColumn::make('total_harga')
                    ->money('IDR'),

                Tables\Columns\BadgeColumn::make('status_transaksi'),

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