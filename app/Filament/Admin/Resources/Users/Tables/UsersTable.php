<?php

namespace App\Filament\Admin\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('system_code')
                    ->label('Código')
                    ->searchable()
                    ->sortable(),

                // No depende de un accessor del modelo (full_name) porque
                // todavía no confirmamos el contenido real de User.php.
                TextColumn::make('first_name')
                    ->label('Nombre completo')
                    ->formatStateUsing(fn ($record) => trim("{$record->first_name} {$record->last_name}"))
                    ->searchable(['first_name', 'last_name', 'second_last_name'])
                    ->sortable(['first_name', 'last_name']),

                TextColumn::make('email')
                    ->label('Correo electrónico')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('section.name')
                    ->label('Sección')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('roles.name')
                    ->label('Roles')
                    ->badge()
                    ->separator(','),

                IconColumn::make('active')
                    ->label('Activo')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
