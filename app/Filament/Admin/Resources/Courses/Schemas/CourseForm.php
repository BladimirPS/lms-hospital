<?php

namespace App\Filament\Admin\Resources\Courses\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class CourseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make()
                    ->columnSpanFull()
                    ->tabs([

                        // ── TAB 1: INFORMACIÓN GENERAL ───────────
                        Tab::make('Información general')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Título del curso')
                                    ->required()
                                    ->maxLength(255),

                                Textarea::make('description')
                                    ->label('Descripción')
                                    ->rows(3),

                                FileUpload::make('cover_image')
                                    ->label('Imagen de portada')
                                    ->image()
                                    ->directory('courses/covers'),

                                Grid::make(2)
                                    ->schema([
                                        Select::make('type')
                                            ->label('Tipo de actividad')
                                            ->options([
                                                'talk'     => 'Charla',
                                                'workshop' => 'Taller',
                                            ])
                                            ->required(),

                                        Select::make('status')
                                            ->label('Estado')
                                            ->options([
                                                'draft'     => 'Borrador',
                                                'published' => 'Publicado',
                                                'archived'  => 'Archivado',
                                            ])
                                            ->default('draft')
                                            ->required(),

                                        DatePicker::make('start_date')
                                            ->label('Fecha de inicio'),

                                        DatePicker::make('due_date')
                                            ->label('Fecha de vencimiento'),

                                        TextInput::make('minimum_score')
                                            ->label('Nota mínima (%)')
                                            ->numeric()
                                            ->default(70)
                                            ->minValue(1)
                                            ->maxValue(100)
                                            ->required(),

                                        TextInput::make('version')
                                            ->label('Versión')
                                            ->numeric()
                                            ->default(1)
                                            ->required(),
                                    ]),

                                Select::make('parent_version_id')
                                    ->label('Versión anterior del curso')
                                    ->relationship('parentVersion', 'title')
                                    ->searchable()
                                    ->nullable(),

                                Hidden::make('creator_id')
                                    ->default(fn() => Auth::id()),
                            ]),

                        // ── TAB 2: CONFIGURACIÓN ─────────────────
                        Tab::make('Configuración')
                            ->icon('heroicon-o-cog-6-tooth')
                            ->schema([
                                Toggle::make('is_free_choice')
                                    ->label('Disponible como libre elección')
                                    ->helperText('Si está activo aparece en el catálogo para todos los empleados.')
                                    ->default(false),

                                Toggle::make('generates_diploma')
                                    ->label('Genera diploma al aprobar')
                                    ->helperText('El diploma se emite automáticamente al aprobar la evaluación.')
                                    ->default(false),

                                Select::make('sections')
                                    ->label('Asignar a secciones')
                                    ->relationship('sections', 'name')
                                    ->multiple()
                                    ->searchable()
                                    ->preload()
                                    ->helperText('Seleccione las secciones que tendrán acceso a este curso.'),
                            ]),


                    ]),
            ]);
    }
}
