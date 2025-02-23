<?php

namespace Modules\Crm\Filament\Resources\ContactResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Modules\Crm\Filament\Resources\ContactResource;

class ViewContact extends ViewRecord
{
    protected static string $resource = ContactResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\EditAction::make()];
    }
}
