<?php

namespace App\Filament\Admin\Resources\Courses\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;


class CoursesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('cover_image')
                    ->label('Portada'),
                TextColumn::make('title')
                    ->label('Título')
                    ->searchable(),
                TextColumn::make('type')
                    ->label('Tipo')
                    ->formatStateUsing(fn ($state) => match($state) {
                        'talk'     => 'Charla',
                        'workshop' => 'Taller',
                        default    => $state,
                    }),
                TextColumn::make('status')
                    ->label('Estado')
                    ->formatStateUsing(fn ($state) => match($state) {
                        'draft'     => 'Borrador',
                        'published' => 'Publicado',
                        'archived'  => 'Archivado',
                        default     => $state,
                    }),
                TextColumn::make('minimum_score')
                    ->label('Nota mínima (%)')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('start_date')
                    ->label('Inicio')
                    ->date()
                    ->sortable(),
                TextColumn::make('due_date')
                    ->label('Vencimiento')
                    ->date()
                    ->sortable(),
                IconColumn::make('is_free_choice')
                    ->label('Libre elección')
                    ->boolean(),
                IconColumn::make('generates_diploma')
                    ->label('Diploma')
                    ->boolean(),
                TextColumn::make('creator.first_name')
                    ->label('Creado por')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->recordActions([
                ViewAction::make()->label('Ver'),
                EditAction::make()->label('Editar'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('Eliminar seleccionados'),
                ]),
            ]);
    }
}
