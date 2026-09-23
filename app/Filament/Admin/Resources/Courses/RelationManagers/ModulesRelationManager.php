<?php

namespace App\Filament\Admin\Resources\Courses\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\Action;


class ModulesRelationManager extends RelationManager
{
    protected static string $relationship = 'modules';
    protected static ?string $title = 'Módulos del curso';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Título del módulo')
                    ->required()
                    ->maxLength(255),
                TextInput::make('order')
                    ->label('Orden')
                    ->numeric()
                    ->default(0),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('order')
                    ->label('#')
                    ->sortable(),
                TextColumn::make('title')
                    ->label('Título del módulo')
                    ->searchable(),
                TextColumn::make('lessons_count')
                    ->label('Lecciones')
                    ->counts('lessons'),
            ])
            ->headerActions([
                CreateAction::make()->label('+ Agregar módulo'),
            ])
            ->recordActions([
                Action::make('gestionar_lecciones')
                    ->label('Gestionar lecciones')
                    ->icon('heroicon-o-book-open')
                    ->color('info')
                    ->url(fn($record) => \App\Filament\Admin\Resources\Modules\ModuleResource::getUrl('edit', ['record' => $record->id])),
                EditAction::make()->label('Editar'),
                DeleteAction::make()->label('Eliminar'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('Eliminar seleccionados'),
                ]),
            ])
            ->defaultSort('order');
    }
}
