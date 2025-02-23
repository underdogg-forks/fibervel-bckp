<?php

namespace Modules\Projects\Filament\Resources;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\Core\Traits\HasDropdownActions;
use Modules\Projects\Filament\Resources\ProjectResource\Pages;
use Modules\Projects\Filament\Resources\ProjectResource\UsersRelationManager;
use Modules\Projects\Models\Project;

class ProjectResource extends Resource
{
    use HasDropdownActions;

    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 7;

    protected static ?string $navigationGroup = 'Admin';

    public static function getModelLabel(): string
    {
        return trans('crud.projects.itemTitle');
    }

    public static function getPluralModelLabel(): string
    {
        return trans('crud.projects.collectionTitle');
    }

    public static function getNavigationLabel(): string
    {
        return trans('crud.projects.collectionTitle');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make()->schema([Grid::make(['default' => 1])->schema([
                TextInput::make('name')->required(),
                Select::make('account_id')
                    ->relationship('account', 'name')
                    ->searchable()
                    ->required(),
                Select::make('users')
                    ->relationship('users', 'name')
                    ->multiple(),
            ])]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('60s')
            ->columns([
                TextColumn::make('name')->limit(10)->sortable()->searchable(),
                TextColumn::make('company.name')->sortable(),
                TextColumn::make('users.name')
                    ->label('Users')
                    ->badge()
                    ->separator(', '),
            ])
            ->filters([])
            ->actions(static::getDropdownActions())
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('name');
    }

    public static function getRelations(): array
    {
        return [
            UsersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
        ];
    }
}
