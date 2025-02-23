<?php

namespace Modules\Crm\Filament\Resources\AccountResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Crm\Filament\Resources\AccountResource;

class ListAccounts extends ListRecords
{
    protected static string $resource = AccountResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()];
    }
}
