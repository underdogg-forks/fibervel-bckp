<?php

namespace Modules\Projects\Filament\Resources\ProjectUserResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Projects\Filament\Resources\ProjectUserResource;

class ListProjectUsers extends ListRecords
{
    protected static string $resource = ProjectUserResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()];
    }
}
