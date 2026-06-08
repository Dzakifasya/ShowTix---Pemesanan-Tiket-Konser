<?php

namespace App\Filament\Resources\Artis\Pages;

use App\Filament\Resources\Artis\ArtisResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditArtis extends EditRecord
{
    protected static string $resource = ArtisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
