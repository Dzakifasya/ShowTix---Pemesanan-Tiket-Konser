<?php

namespace App\Filament\Resources\Konsers\Pages;

use App\Filament\Resources\Konsers\KonserResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditKonser extends EditRecord
{
    protected static string $resource = KonserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
