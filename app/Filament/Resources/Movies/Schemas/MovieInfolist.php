<?php

namespace App\Filament\Resources\Movies\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class MovieInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title'),
                TextEntry::make('release_year')
                    ->numeric(),
                TextEntry::make('director'),
                TextEntry::make('genre'),
                TextEntry::make('plot')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
