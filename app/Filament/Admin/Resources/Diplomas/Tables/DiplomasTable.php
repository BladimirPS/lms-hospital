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
                    ->searchable(),
                TextColumn::make('attempt.id')
                    ->searchable(),
                TextColumn::make('diploma_code')
                    ->searchable(),
                TextColumn::make('manager_name')
                    ->searchable(),
                TextColumn::make('obtained_score')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('issued_at')
                    ->date()
                    ->sortable(),
                TextColumn::make('pdf_path')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
