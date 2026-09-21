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
                    ->label('Inscripción'),
                TextEntry::make('attempt.id')
                    ->label('Intento'),
                TextEntry::make('diploma_code')
                    ->label('Código de diploma'),
                TextEntry::make('manager_name')
                    ->label('Nombre del encargado'),
                TextEntry::make('obtained_score')
                    ->label('Calificación obtenida')
                    ->numeric(),
                TextEntry::make('issued_at')
                    ->label('Fecha de emisión')
                    ->date(),
                TextEntry::make('pdf_path')
                    ->label('Ruta del documento')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->label('Fecha de creación')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('Última actualización')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
