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
use Modules\Crm\Filament\Resources\LeadResource\Pages\ListLeads;
use Modules\Crm\Filament\Resources\LeadResource\RelationManagers;
use Modules\Crm\Models\Lead;

class LeadResource extends Resource
{
    protected static ?string $model = Lead::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make()->schema([Grid::make(['default' => 1])->schema([
                TextInput::make('name')->required(),
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
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('account.name')->sortable(),
            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\AccountRelationManager::class,
            RelationManagers\ContactRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLeads::route('/'),
        ];
    }
}
