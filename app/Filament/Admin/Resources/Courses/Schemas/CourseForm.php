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

                        // ── TAB 3: MÓDULOS Y LECCIONES ───────────
                        Tab::make('Contenido')
                            ->icon('heroicon-o-book-open')
                            ->schema([
                                Repeater::make('modules')
                                    ->label('Módulos')
                                    ->relationship('modules')
                                    ->orderColumn('order')
                                    ->collapsible()


                                    ->itemLabel(
                                        fn(array $state): ?string =>
                                        $state['title'] ? 'Módulo: ' . $state['title'] : 'Nuevo módulo'
                                    )
                                    ->cloneable()
                                    ->addActionLabel('+ Agregar módulo')
                                    ->extraAttributes(['style' => 'background-color: #EBF3FB; border-left: 4px solid #1A3A5C; border-radius: 8px; padding: 4px;'])
                                    ->schema([
                                        TextInput::make('title')
                                            ->label('Título del módulo')
                                            ->required()
                                            ->maxLength(255),

                                        Repeater::make('lessons')
                                            ->label('Lecciones')
                                            ->relationship('lessons')
                                            ->orderColumn('order')
                                            ->collapsible()
                                            ->itemLabel(
                                                fn(array $state): ?string =>
                                                match ($state['type'] ?? null) {
                                                    'server_video'  => '🎬 ' . ($state['title'] ?? 'Nueva lección'),
                                                    'youtube_video' => '▶️ ' . ($state['title'] ?? 'Nueva lección'),
                                                    'pdf'           => '📄 ' . ($state['title'] ?? 'Nueva lección'),
                                                    'article'       => '📝 ' . ($state['title'] ?? 'Nueva lección'),
                                                    default         => '📚 ' . ($state['title'] ?? 'Nueva lección'),
                                                }
                                            )
                                            ->addActionLabel('+ Agregar lección')
                                            ->extraAttributes(['style' => 'background-color: #EDFAF1; border-left: 4px solid #27AE60; border-radius: 8px; padding: 4px;'])
                                            ->schema([
                                                Grid::make(2)
                                                    ->schema([
                                                        TextInput::make('title')
                                                            ->label('Título de la lección')
                                                            ->required()
                                                            ->maxLength(255),

                                                        Select::make('type')
                                                            ->label('Tipo de contenido')
                                                            ->options([
                                                                'server_video'  => 'Video del servidor',
                                                                'youtube_video' => 'Video de YouTube',
                                                                'pdf'           => 'Documento PDF',
                                                                'article'       => 'Artículo',
                                                            ])
                                                            ->required()
                                                            ->live(),
                                                    ]),

                                                Textarea::make('description')
                                                    ->label('Descripción breve')
                                                    ->rows(2),

                                                FileUpload::make('file_path')
                                                    ->label('Archivo de video')
                                                    ->directory('lessons/videos')
                                                    ->acceptedFileTypes(['video/mp4', 'video/avi', 'video/mov'])
                                                    ->maxSize(512000)
                                                    ->visible(fn($get) => $get('type') === 'server_video'),

                                                TextInput::make('youtube_url')
                                                    ->label('URL de YouTube')
                                                    ->url()
                                                    ->placeholder('https://www.youtube.com/watch?v=...')
                                                    ->visible(fn($get) => $get('type') === 'youtube_video'),

                                                FileUpload::make('file_path')
                                                    ->label('Archivo PDF')
                                                    ->directory('lessons/pdfs')
                                                    ->acceptedFileTypes(['application/pdf'])
                                                    ->visible(fn($get) => $get('type') === 'pdf'),

                                                RichEditor::make('content')
                                                    ->label('Contenido del artículo')
                                                    ->visible(fn($get) => $get('type') === 'article'),
                                            ]),
                                    ]),
                            ]),
                    ]),
            ]);
    }
}
