<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Course;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class CoursesStatusTable extends BaseWidget
{
    protected static ?int $sort = 2;
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Course::query()
                    ->where('status', 'published')
                    ->withCount('enrollments')
                    ->withAvg('enrollments', 'progress')
            )
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Curso')
                    ->searchable(),

                Tables\Columns\TextColumn::make('type')
                    ->label('Tipo')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'talk' => 'Charla',
                        'workshop' => 'Taller',
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('enrollments_count')
                    ->label('Inscritos'),

                Tables\Columns\TextColumn::make('enrollments_avg_progress')
                    ->label('Progreso promedio')
                    ->formatStateUsing(fn ($state) => round($state ?? 0) . '%'),

                Tables\Columns\TextColumn::make('due_date')
                    ->label('Vencimiento')
                    ->date()
                    ->badge()
                    ->color(fn ($record) => match (true) {
                        $record->due_date === null => 'gray',
                        $record->due_date < now() => 'danger',
                        $record->due_date <= now()->addDays(15) => 'warning',
                        default => 'success',
                    }),
            ])
            ->defaultSort('due_date', 'asc')
            ->heading('Estado de cursos activos');
    }
}
