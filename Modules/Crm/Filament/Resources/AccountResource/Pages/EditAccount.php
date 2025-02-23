<?php

namespace Modules\Crm\Filament\Resources\AccountResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Crm\Filament\Resources\AccountResource;

class EditAccount extends EditRecord
{
    protected static string $resource = AccountResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\DeleteAction::make()];
    }
}
