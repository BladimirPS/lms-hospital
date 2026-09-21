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
                TextEntry::make('title')
                    ->label('Título del curso'),
                TextEntry::make('description')
                    ->label('Descripción')
                    ->placeholder('-')
                    ->columnSpanFull(),
                ImageEntry::make('cover_image')
                    ->label('Imagen de portada')
                    ->placeholder('-'),
                TextEntry::make('type')
                    ->label('Tipo')
                    ->formatStateUsing(fn ($state) => match($state) {
                        'talk'     => 'Charla',
                        'workshop' => 'Taller',
                        default    => $state,
                    }),
                TextEntry::make('version')
                    ->label('Versión')
                    ->numeric(),
                TextEntry::make('parentVersion.title')
                    ->label('Versión anterior')
                    ->placeholder('-'),
                IconEntry::make('is_free_choice')
                    ->label('Libre elección')
                    ->boolean(),
                IconEntry::make('generates_diploma')
                    ->label('Genera diploma')
                    ->boolean(),
                TextEntry::make('minimum_score')
                    ->label('Nota mínima (%)')
                    ->numeric(),
                TextEntry::make('start_date')
                    ->label('Fecha de inicio')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('due_date')
                    ->label('Fecha de vencimiento')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('status')
                    ->label('Estado')
                    ->formatStateUsing(fn ($state) => match($state) {
                        'draft'     => 'Borrador',
                        'published' => 'Publicado',
                        'archived'  => 'Archivado',
                        default     => $state,
                    }),
                TextEntry::make('creator.first_name')
                    ->label('Creado por'),
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
