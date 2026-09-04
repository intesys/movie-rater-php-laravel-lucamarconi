<?php

namespace App\Filament\Resources\Movies\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class MovieForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('release_year')
                    ->required()
                    ->numeric(),
                TextInput::make('director')
                    ->required(),
                TextInput::make('cast')
                    ->required(),
                TextInput::make('genre')
                    ->required(),
                Textarea::make('plot')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
