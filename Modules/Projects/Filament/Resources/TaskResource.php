<?php

namespace Modules\Projects\Filament\Resources;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\Core\Traits\HasDropdownActions;
use Modules\Projects\Filament\Resources\TaskResource\Pages\ListTasks;
use Modules\Projects\Filament\Resources\TaskResource\RelationManagers\ProjectsRelationManager;
use Modules\Projects\Models\Task;

class TaskResource extends Resource
{
    use HasDropdownActions;

    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Admin';

    protected static ?int $navigationSort = 8;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('project.name')->limit(10)->sortable(),
                TextColumn::make('subject')->sortable(),
                TextColumn::make('status')->sortable(),
                TextColumn::make('due_at')->sortable(),
            ])
            ->filters([
            ])
            ->actions(static::getDropdownActions())
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ProjectsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTasks::route('/'),
        ];
    }
}
