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
                    ->required(),
                Select::make('subdirection_id')
                    ->relationship('subdirection', 'name')
                    ->required(),
            ]);
    }
}
