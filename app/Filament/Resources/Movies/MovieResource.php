<?php

namespace App\Filament\Resources\Movies;

use App\Filament\Resources\Movies\Pages\CreateMovie;
use App\Filament\Resources\Movies\Pages\EditMovie;
use App\Filament\Resources\Movies\Pages\ListMovies;
use App\Filament\Resources\Movies\Pages\ViewMovie;
use App\Filament\Resources\Movies\Schemas\MovieForm;
use App\Filament\Resources\Movies\Schemas\MovieInfolist;
use App\Filament\Resources\Movies\Tables\MoviesTable;
use App\Models\Movie;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Validation\Rules\Unique;

class MovieResource extends Resource
{
    protected static ?string $model = Movie::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Movie';

    public static function form(Schema $schema): Schema
    {
//        return MovieForm::configure($schema);

        return $schema
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->unique(
                        table: 'movies',
                        ignoreRecord: true,
                        modifyRuleUsing: function (Unique $rule, Get $get) {
                            return $rule->where('release_year', $get('release_year'));
                        }
                    ),

                TextInput::make('release_year')
                    ->required()
                    ->numeric()
                    ->minValue(1888)
                    ->maxValue(now()->year),

                TextInput::make('director')
                    ->required()
                    ->maxLength(255),

                TextInput::make('genre')
                    ->required()
                    ->maxLength(50),

                TagsInput::make('cast')
                    ->required()
                    ->placeholder('Aggiungi un attore e premi invio'),

                Textarea::make('plot')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
//        return MovieInfolist::configure($schema);

        return $schema
            ->schema([
                TextEntry::make('title'),

                TextEntry::make('release_year'),

                TextEntry::make('director'),

                TextEntry::make('genre'),

                TextEntry::make('cast')
                    ->badge(),
            ]);
    }

    public static function table(Table $table): Table
    {
//        return MoviesTable::configure($table);

        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable(),

                TextColumn::make('release_year')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('director')
                    ->searchable(),

                TextColumn::make('genre')
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('genre')
                    ->label('Genre')
                    ->options(fn () => Movie::pluck('genre', 'genre')->toArray()),

                SelectFilter::make('release_year')
                    ->label('Release Year')
                    ->options(fn () => Movie::orderBy('release_year', 'desc')->pluck('release_year', 'release_year')->toArray()),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
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
            'index' => ListMovies::route('/'),
            'create' => CreateMovie::route('/create'),
            'view' => ViewMovie::route('/{record}'),
            'edit' => EditMovie::route('/{record}/edit'),
        ];
    }
}
