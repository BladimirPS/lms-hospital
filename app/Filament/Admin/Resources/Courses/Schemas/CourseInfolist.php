<?php

namespace App\Filament\Admin\Resources\Courses\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CourseInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title'),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                ImageEntry::make('cover_image')
                    ->placeholder('-'),
                TextEntry::make('type'),
                TextEntry::make('version')
                    ->numeric(),
                TextEntry::make('parentVersion.title')
                    ->label('Parent version')
                    ->placeholder('-'),
                IconEntry::make('is_free_choice')
                    ->boolean(),
                IconEntry::make('generates_diploma')
                    ->boolean(),
                TextEntry::make('minimum_score')
                    ->numeric(),
                TextEntry::make('start_date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('due_date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('status'),
                TextEntry::make('creator.id')
                    ->label('Creator'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
