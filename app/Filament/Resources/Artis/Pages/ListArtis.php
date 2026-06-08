<?php

namespace App\Filament\Resources\Artis\Pages;

use App\Filament\Resources\Artis\ArtisResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListArtis extends ListRecords
{
    protected static string $resource = ArtisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
