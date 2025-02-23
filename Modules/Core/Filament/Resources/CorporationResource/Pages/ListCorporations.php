<?php

namespace Modules\Core\Filament\Resources\CorporationResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Core\Filament\Resources\CorporationResource;

class ListCorporations extends ListRecords
{
    protected static string $resource = CorporationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
