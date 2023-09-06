<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EraResource\Pages;
use App\Filament\Resources\EraResource\RelationManagers;
use App\Models\Era;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;


class EraResource extends Resource
{
    protected static ?string $model = Era::class;

    protected static ?string $navigationIcon = 'heroicon-o-square-2-stack';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Dates')->schema([
                    TextInput::make('year')->numeric()->label('Starting Year'),
                    TextInput::make('end_year')->numeric()->label('Ending Year')
                ]),
                Fieldset::make('Copy')->schema([
                    TextInput::make('headline'),
                    RichEditor::make('text'),
                ])->columns(1),
                Fieldset::make('Organize')->schema([
                    Select::make('publication_status_id')->relationship('publication_status','name')
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEras::route('/'),
            'create' => Pages\CreateEra::route('/create'),
            'edit' => Pages\EditEra::route('/{record}/edit'),
        ];
    }    
}
