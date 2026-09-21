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
                    ->label('Inscripción')
                    ->relationship('enrollment', 'id')
                    ->required(),
                Select::make('attempt_id')
                    ->label('Intento de evaluación')
                    ->relationship('attempt', 'id')
                    ->required(),
                TextInput::make('diploma_code')
                    ->label('Código de diploma')
                    ->required(),
                TextInput::make('manager_name')
                    ->label('Nombre del encargado')
                    ->required(),
                TextInput::make('obtained_score')
                    ->label('Calificación obtenida')
                    ->required()
                    ->numeric(),
                DatePicker::make('issued_at')
                    ->label('Fecha de emisión')
                    ->required(),
                TextInput::make('pdf_path')
                    ->label('Ruta del documento'),
            ]);
    }
}
