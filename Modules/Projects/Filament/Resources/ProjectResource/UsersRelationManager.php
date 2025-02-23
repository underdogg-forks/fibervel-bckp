<?php

namespace Modules\Projects\Filament\Resources\ProjectResource;

use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Actions\DetachAction;
use Filament\Tables\Columns\TextColumn;
use Modules\Core\Traits\HasDropdownActions;

class UsersRelationManager extends RelationManager
{

    use HasDropdownActions;

    protected static string $relationship = 'users';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Select::make('users')
                    ->relationship('users', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->required(),
            ]);
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('email')->sortable()->searchable(),
            ])
            ->headerActions([
                AttachAction::make(),
            ])
            ->actions([
                DetachAction::make(),
            ]);
    }
}
