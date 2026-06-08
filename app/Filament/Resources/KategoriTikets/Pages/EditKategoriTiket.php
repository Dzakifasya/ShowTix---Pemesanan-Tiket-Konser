<?php

namespace App\Filament\Resources\KategoriTikets\Pages;

use App\Filament\Resources\KategoriTikets\KategoriTiketResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditKategoriTiket extends EditRecord
{
    protected static string $resource = KategoriTiketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
