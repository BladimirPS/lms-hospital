<?php

namespace App\Filament\Admin\Resources\Diplomas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DiplomasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('enrollment.id')
                    ->label('Inscripción')
                    ->searchable(),
                TextColumn::make('diploma_code')
                    ->label('Código de diploma')
                    ->searchable(),
                TextColumn::make('manager_name')
                    ->label('Encargado')
                    ->searchable(),
                TextColumn::make('obtained_score')
                    ->label('Calificación')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('issued_at')
                    ->label('Fecha de emisión')
                    ->date()
                    ->sortable(),
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
