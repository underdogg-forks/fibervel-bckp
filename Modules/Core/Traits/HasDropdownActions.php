<?php

namespace Modules\Core\Traits;

use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;

trait HasDropdownActions
{
    public static function getDropdownActions(): array
    {
        return [
            ActionGroup::make([
                EditAction::make(),
                ViewAction::make(),
            ]),
        ];
    }
}
