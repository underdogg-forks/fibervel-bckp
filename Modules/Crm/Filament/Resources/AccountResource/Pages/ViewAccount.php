<?php

namespace Modules\Crm\Filament\Resources\AccountResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Modules\Crm\Filament\Resources\AccountResource;

class ViewAccount extends ViewRecord
{
    protected static string $resource = AccountResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\EditAction::make()];
    }
}
