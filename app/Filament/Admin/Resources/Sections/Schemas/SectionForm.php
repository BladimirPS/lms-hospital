<?php

namespace App\Filament\Admin\Resources\Sections\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255),

                Select::make('subdirection_id')
                    ->label('Subdirección')
                    ->relationship('subdirection', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
            ]);
    }
}
