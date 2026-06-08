<?php

namespace App\Filament\Widgets;

use App\Models\Konser;
use App\Models\Pembeli;
use App\Models\Transaksi;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [

            Stat::make(
                'Total Konser',
                Konser::count()
            ),

            Stat::make(
                'Total Pembeli',
                Pembeli::count()
            ),

            Stat::make(
                'Total Transaksi',
                Transaksi::count()
            ),

            Stat::make(
                'Pendapatan',
                'Rp ' . number_format(
                    Transaksi::where('status_transaksi', 'Berhasil')
                        ->sum('total_harga'),
                    0,
                    ',',
                    '.'
                )
            ),

        ];
    }
}