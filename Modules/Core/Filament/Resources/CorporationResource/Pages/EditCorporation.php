<?php

namespace Modules\Core\Filament\Resources\CorporationResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Core\Filament\Resources\CorporationResource;

class EditCorporation extends EditRecord
{
    protected static string $resource = CorporationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
