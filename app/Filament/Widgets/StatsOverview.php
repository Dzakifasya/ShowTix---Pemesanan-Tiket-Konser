<?php

namespace App\Filament\Widgets;

use App\Models\Konser;
use App\Models\Pembeli;
use App\Models\Pemesanan;
use App\Models\Transaksi;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [

            Stat::make(
                '🎵 Total Konser',
                Konser::count()
            )
            ->description('Konser aktif')
            ->color('primary'),

            Stat::make(
                '👥 Total Pembeli',
                Pembeli::count()
            )
            ->description('Pengguna sistem')
            ->color('success'),

            Stat::make(
                '🎫 Total Pemesanan',
                Pemesanan::count()
            )
            ->description('Tiket dipesan')
            ->color('warning'),

            Stat::make(
                '💳 Total Transaksi',
                Transaksi::count()
            )
            ->description('Pembayaran')
            ->color('danger'),
        ];
    }
}