<?php

namespace App\Filament\Admin\Resources\Diplomas\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class DiplomaInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('enrollment.id')
                    ->label('Enrollment'),
                TextEntry::make('attempt.id')
                    ->label('Attempt'),
                TextEntry::make('diploma_code'),
                TextEntry::make('manager_name'),
                TextEntry::make('obtained_score')
                    ->numeric(),
                TextEntry::make('issued_at')
                    ->date(),
                TextEntry::make('pdf_path')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
