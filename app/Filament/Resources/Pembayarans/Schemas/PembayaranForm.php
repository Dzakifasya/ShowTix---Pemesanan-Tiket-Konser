<?php

namespace App\Filament\Resources\Pembayarans\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PembayaranForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

               Select::make('transaksi_id')
            ->relationship(
                'transaksi',
                'kode_transaksi',
                fn ($query) => $query->doesntHave('pembayaran')
            )
            ->searchable()
            ->preload()
            ->required(),

                TextInput::make('jumlah_bayar')
                    ->numeric(),

                TextInput::make('metode_pembayaran'),

                Select::make('status_pembayaran')
                    ->options([
                        'Pending'=>'Pending',
                        'Berhasil'=>'Berhasil',
                        'Gagal'=>'Gagal',
                    ]),

                FileUpload::make('bukti_pembayaran'),
            ]);
    }
}