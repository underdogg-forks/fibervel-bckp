<?php

namespace Modules\Projects\Filament\Resources;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Core\Traits\HasDropdownActions;
use Modules\Projects\Filament\Resources\ProjectUserResource\Pages;
use Modules\Projects\Models\ProjectUser;

class ProjectUserResource extends Resource
{
    use HasDropdownActions;

    protected static ?string $model = ProjectUser::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Admin';

    protected static bool $shouldRegisterNavigation = false;

    public static function getModelLabel(): string
    {
        return trans('crud.projectUsers.itemTitle');
    }

    public static function getPluralModelLabel(): string
    {
        return trans('crud.projectUsers.collectionTitle');
    }

    public static function getNavigationLabel(): string
    {
        return trans('crud.projectUsers.collectionTitle');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make()->schema([Grid::make(['default' => 1])->schema([])]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('60s')
            ->columns([
                Tables\Columns\TextColumn::make('users.name'),
            ])
            ->filters([])
            ->actions(static::getDropdownActions())
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('id', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjectUsers::route('/'),
        ];
    }
}
