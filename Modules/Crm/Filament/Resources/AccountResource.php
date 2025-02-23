<?php

namespace Modules\Crm\Filament\Resources;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\Core\Filament\Resources\CompanyResource\RelationManagers\ContactsRelationManager;
use Modules\Core\Filament\Resources\CompanyResource\RelationManagers\LeadsRelationManager;
use Modules\Core\Filament\Resources\CompanyResource\RelationManagers\ProjectsRelationManager;
use Modules\Core\Traits\HasDropdownActions;
use Modules\Crm\Filament\Resources\AccountResource\Pages;
use Modules\Crm\Models\Account;

class AccountResource extends Resource
{
    use HasDropdownActions;

    protected static ?string $model = Account::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Admin';

    public static function getModelLabel(): string
    {
        return trans('crud.accounts.itemTitle');
    }

    public static function getPluralModelLabel(): string
    {
        return trans('crud.accounts.collectionTitle');
    }

    public static function getNavigationLabel(): string
    {
        return trans('crud.accounts.collectionTitle');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make()->schema([Grid::make(['default' => 1])->schema([
                TextInput::make('name')->required(),
                TextInput::make('phone')->required(),
            ])]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('60s')
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('phone')->sortable()->searchable(),
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
            ContactsRelationManager::class,
            LeadsRelationManager::class,
            ProjectsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAccounts::route('/'),
        ];
    }
}
