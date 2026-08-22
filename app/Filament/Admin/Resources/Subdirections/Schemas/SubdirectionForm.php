<?php

namespace App\Filament\Admin\Resources\Subdirections\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SubdirectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
            ]);
    }
}
