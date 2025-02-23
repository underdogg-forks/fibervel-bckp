<?php

namespace Modules\Projects\Filament\Resources\ProjectUserResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Projects\Filament\Resources\ProjectUserResource;

class EditProjectUser extends EditRecord
{
    protected static string $resource = ProjectUserResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\DeleteAction::make()];
    }
}
