<?php

namespace Modules\Projects\Filament\Resources\ProjectUserResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Projects\Filament\Resources\ProjectUserResource;

class CreateProjectUser extends CreateRecord
{
    protected static string $resource = ProjectUserResource::class;
}
