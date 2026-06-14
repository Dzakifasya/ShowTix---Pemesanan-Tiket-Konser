<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\StatsOverview;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public function getWidgets(): array
    {
        return [
            StatsOverview::class,
        ];
    }
    protected static ?string $title = 'ShowTix Dashboard';

    public function getHeading(): string
    {
        return '🎫 ShowTix Admin Dashboard';
    }

    public function getSubheading(): ?string
    {
        return 'Concert Ticket Management System';
    }
    
}