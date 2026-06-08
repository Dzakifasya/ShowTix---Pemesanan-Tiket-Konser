<?php

namespace App\Filament\Resources\Konsers\Pages;

use App\Filament\Resources\Konsers\KonserResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListKonsers extends ListRecords
{
    protected static string $resource = KonserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
