<?php

namespace App\Filament\Resources\Pembayarans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables;
use Filament\Tables\Table;

class PembayaransTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('transaksi.kode_transaksi'),

                Tables\Columns\TextColumn::make('jumlah_bayar')
                    ->money('IDR'),

                Tables\Columns\TextColumn::make('metode_pembayaran'),

                Tables\Columns\BadgeColumn::make('status_pembayaran'),
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