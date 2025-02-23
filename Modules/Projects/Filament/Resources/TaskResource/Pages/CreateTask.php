<?php

namespace Modules\Projects\Filament\Resources\TaskResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Projects\Filament\Resources\TaskResource;

class CreateTask extends CreateRecord
{
    protected static string $resource = TaskResource::class;
}
