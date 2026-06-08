<?php

namespace App\Filament\Resources\KategoriTikets\Pages;

use App\Filament\Resources\KategoriTikets\KategoriTiketResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListKategoriTikets extends ListRecords
{
    protected static string $resource = KategoriTiketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
