<?php

namespace Modules\Projects\Filament\Resources\ProjectUserResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Modules\Projects\Filament\Resources\ProjectUserResource;

class ViewProjectUser extends ViewRecord
{
    protected static string $resource = ProjectUserResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\EditAction::make()];
    }
}
