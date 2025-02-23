<?php

namespace Modules\Core\Filament\Resources\CompanyResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Core\Filament\Resources\CompanyResource;

class ListCompanies extends ListRecords
{
    protected static string $resource = CompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()];
    }
}
