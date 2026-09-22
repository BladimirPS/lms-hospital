<?php

namespace App\Filament\Admin\Resources\Courses\RelationManagers;

use App\Models\Enrollment;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\Action;



class EnrollmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'enrollments';
    protected static ?string $title = 'Usuarios inscritos';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Empleado')
                    ->relationship('user', 'first_name')
                    ->getOptionLabelFromRecordUsing(
                        fn($record) =>
                        "{$record->first_name} {$record->last_name} — {$record->section?->name}"
                    )
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('status')
                    ->label('Estado')
                    ->options([
                        'in_progress' => 'En progreso',
                        'completed'   => 'Completado',
                        'abandoned'   => 'Abandonado',
                    ])
                    ->default('in_progress')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('user.first_name')
            ->selectable()
            ->columns([
                TextColumn::make('user.first_name')
                    ->label('Nombre')
                    ->sortable()
                    ->formatStateUsing(
                        fn($record) =>
                        "{$record->user->first_name} {$record->user->last_name}"
                    )
                    ->searchable(),
                TextColumn::make('user.section.name')
                    ->label('Sección')
                    ->searchable(),
                TextColumn::make('status')
                    ->label('Estado')
                    ->sortable()
                    ->formatStateUsing(fn($state) => match ($state) {
                        'in_progress' => 'En progreso',
                        'completed'   => 'Completado',
                        'abandoned'   => 'Abandonado',
                        default       => $state,
                    })
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        'in_progress' => 'warning',
                        'completed'   => 'success',
                        'abandoned'   => 'danger',
                        default       => 'gray',
                    }),
                TextColumn::make('progress')
                    ->label('Progreso (%)')
                    ->sortable(),
                TextColumn::make('enrolled_at')
                    ->label('Inscrito el')
                    ->date()
                    ->sortable(),
                TextColumn::make('completed_at')
                    ->label('Completado el')
                    ->date()
                    ->placeholder('Pendiente')
                    ->sortable(),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('+ Inscribir empleado')
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['enrolled_at'] = now();
                        $data['progress'] = 0;
                        return $data;
                    }),
            ])
            ->recordActions([
                EditAction::make()->label('Editar'),
                Action::make('desasignar')
                    ->label('Desasignar')
                    ->color('danger')
                    ->icon('heroicon-o-x-circle')
                    ->requiresConfirmation()
                    ->modalHeading('Desasignar empleado')
                    ->modalDescription('¿Está seguro que desea desasignar este empleado del curso?')
                    ->action(fn($record) => $record->update(['status' => 'abandoned']))
                    ->visible(fn($record) => $record?->status !== 'abandoned'),
                Action::make('Reactivar')
                    ->label('Reactivar')
                    ->color('success')
                    ->icon('heroicon-o-check-circle')
                    ->requiresConfirmation()
                    ->modalHeading('Reactivar empleado')
                    ->modalDescription('¿Está seguro que desea reactivar este empleado en el curso?')

                    ->action(fn($record) => $record->update(['status' => "in_progress"]))
                    ->visible(fn($record) => $record?->status === "abandoned"),

            ])
            ->bulkActions([
    BulkActionGroup::make([
        \Filament\Actions\BulkAction::make('desasignar_seleccionados')
            ->label('Desasignar seleccionados')
            ->color('danger')
            ->icon('heroicon-o-x-circle')
            ->requiresConfirmation()
            ->modalHeading('Desasignar empleados')
            ->modalDescription('¿Está seguro que desea desasignar los empleados seleccionados?')
            ->action(fn ($records) => $records->each->update(['status' => 'abandoned'])),

        \Filament\Actions\BulkAction::make('reactivar_seleccionados')
            ->label('Reactivar seleccionados')
            ->color('success')
            ->icon('heroicon-o-check-circle')
            ->requiresConfirmation()
            ->modalHeading('Reactivar empleados')
            ->modalDescription('¿Está seguro que desea reactivar los empleados seleccionados?')
            ->action(fn ($records) => $records->each->update(['status' => 'in_progress'])),
    ])
    ]);
    }
}
