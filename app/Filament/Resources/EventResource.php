<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\IconColumn;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\ColorPicker;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Dates')->schema([
                    Fieldset::make('Start Date')->schema([
                        TextInput::make('month')->numeric()->minValue(1)->maxValue(12),
                        TextInput::make('year')->numeric()->inputMode('numeric'),
                    ]),
                    Fieldset::make('End Date')->schema([
                        TextInput::make('end_month')->numeric()->minValue(1)->maxValue(12)->label('Month'),
                        TextInput::make('end_year')->numeric()->inputMode('numeric')->label('Year'),
                    ]),
                    TextInput::make('display_date'),
                ])
                ->columns(3),
                Fieldset::make('Copy')->schema([
                    TextInput::make('headline'),
                    RichEditor::make('text'),
                ])
                ->columns(1),
                Fieldset::make('Media')->schema([
                    TextInput::make('media')->url(),
                    TextInput::make('media_credit'),
                    TextInput::make('media_thumbnail'),
                    TextInput::make('media_caption'),
                ])->columns(2),
                Fieldset::make('Background')->schema([
                    ColorPicker::make('background_color')->hsl(),
                    TextInput::make('background_image'),
                    TextInput::make('background_image_description'),
                ]),
                Fieldset::make('Organize')->schema([
                    Select::make('event_group_id')->relationship('event_group', 'name'),
                    Select::make('publication_status_id')->relationship('publication_status','name')->required()
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('headline'),
                TextColumn::make('year')->sortable(),
                TextColumn::make('end_year'),
                TextColumn::make('event_group.name'),
                IconColumn::make('publication_status.name')
                    ->icon(fn (string $state): string => match ($state) {
                        'draft' => 'heroicon-o-pencil',
                        'staging' => 'heroicon-o-clock',
                        'production' => 'heroicon-o-check-circle',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'info',
                        'staging' => 'warning',
                        'production' => 'success',
                        default => 'gray',
                    })
            ])
            ->defaultSort('year', 'desc')
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }    
}
