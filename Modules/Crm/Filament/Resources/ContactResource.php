<?php

namespace Modules\Crm\Filament\Resources;

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
use Modules\Crm\Filament\Resources\ContactResource\AccountRelationManager;
use Modules\Crm\Filament\Resources\ContactResource\Pages;
use Modules\Crm\Models\Contact;

class ContactResource extends Resource
{
    use HasDropdownActions;

    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Admin';

    public static function getModelLabel(): string
    {
        return trans('crud.contacts.itemTitle');
    }

    public static function getPluralModelLabel(): string
    {
        return trans('crud.contacts.collectionTitle');
    }

    public static function getNavigationLabel(): string
    {
        return trans('crud.contacts.collectionTitle');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make()->schema([Grid::make(['default' => 1])->schema([
                TextInput::make('first_name')->required(),
                TextInput::make('last_name')->required(),
                Select::make('account_id')
                    ->relationship('account', 'name')
                    ->searchable()
                    ->required(),
            ])]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('60s')
            ->columns([
                TextColumn::make('account.name')->sortable(),
                TextColumn::make('first_name')->sortable()->searchable(),
                TextColumn::make('last_name')->sortable()->searchable(),
            ])
            ->filters([])
            ->actions(static::getDropdownActions())
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('last_name');
    }

    public static function getRelations(): array
    {
        return [
            AccountRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContacts::route('/'),
        ];
    }
}
