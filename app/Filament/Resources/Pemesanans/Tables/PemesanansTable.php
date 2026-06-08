<?php

namespace App\Filament\Resources\Pemesanans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables;
use Filament\Tables\Table;

class PemesanansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('transaksi.kode_transaksi')
                    ->label('Transaksi'),

                Tables\Columns\TextColumn::make('kategoriTiket.nama_kategori')
                    ->label('Kategori'),

                Tables\Columns\TextColumn::make('jumlah_tiket'),

                Tables\Columns\TextColumn::make('harga_satuan')
                    ->money('IDR'),

                Tables\Columns\TextColumn::make('subtotal')
                    ->money('IDR'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y'),
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