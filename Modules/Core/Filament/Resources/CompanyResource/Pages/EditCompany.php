<?php

namespace Modules\Core\Filament\Resources\CompanyResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Core\Filament\Resources\CompanyResource;

class EditCompany extends EditRecord
{
    protected static string $resource = CompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\DeleteAction::make()];
    }
}
