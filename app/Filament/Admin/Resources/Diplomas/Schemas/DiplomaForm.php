<?php

namespace App\Filament\Admin\Resources\Diplomas\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DiplomaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('enrollment_id')
                    ->relationship('enrollment', 'id')
                    ->required(),
                Select::make('attempt_id')
                    ->relationship('attempt', 'id')
                    ->required(),
                TextInput::make('diploma_code')
                    ->required(),
                TextInput::make('manager_name')
                    ->required(),
                TextInput::make('obtained_score')
                    ->required()
                    ->numeric(),
                DatePicker::make('issued_at')
                    ->required(),
                TextInput::make('pdf_path'),
            ]);
    }
}
