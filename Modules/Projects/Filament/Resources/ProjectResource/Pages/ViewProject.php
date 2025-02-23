<?php

namespace Modules\Projects\Filament\Resources\ProjectResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Modules\Projects\Filament\Resources\ProjectResource;

class ViewProject extends ViewRecord
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\EditAction::make()];
    }
}
