<?php

namespace Modules\Core\Filament\Resources;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Filament\Resources\UserResource\Pages;
use Modules\Core\Models\User;
use Modules\Core\Traits\HasDropdownActions;

class UserResource extends Resource
{
    use HasDropdownActions;

    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 99;

    protected static ?string $navigationGroup = 'Admin';

    public static function getModelLabel(): string
    {
        return trans('crud.users.itemTitle');
    }

    public static function getPluralModelLabel(): string
    {
        return trans('crud.users.collectionTitle');
    }

    public static function getNavigationLabel(): string
    {
        return trans('crud.users.collectionTitle');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make()->schema([
                Grid::make(['default' => 1])->schema([
                    TextInput::make('name')
                        ->required()
                        ->string()
                        ->autofocus(),

                    TextInput::make('email')
                        ->required()
                        ->string()
                        ->unique('users', 'email', ignoreRecord: true)
                        ->email(),

                    TextInput::make('password')
                        ->required(
                            fn (string $context): bool => $context === 'create'
                        )
                        ->dehydrated(fn ($state) => filled($state))
                        ->string()
                        ->minLength(6)
                        ->password(),
                    Select::make('roles')
                        ->relationship(name: 'roles', titleAttribute: 'name')
                        ->saveRelationshipsUsing(function (Model $record, $state): void {
                            $record->roles()->syncWithPivotValues($state, [config('permission.column_names.team_foreign_key') => getPermissionsTeamId()]);
                        })
                        ->multiple()
                        ->preload()
                        ->searchable(),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('60s')
            ->columns([TextColumn::make('name'), TextColumn::make('email')])
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
        ];
    }
}
