<?php

namespace App\Filament\Admin\Resources\Modules\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LessonsRelationManager extends RelationManager
{
    protected static string $relationship = 'lessons';
    protected static ?string $title = 'Lecciones';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
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

                Textarea::make('description')
                    ->label('Descripción breve')
                    ->rows(2),

                FileUpload::make('file_path')
                    ->label('Archivo de video')
                    ->disk('public')
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
                    ->disk('public')
                    ->directory('lessons/pdfs')
                    ->acceptedFileTypes(['application/pdf'])
                    ->visible(fn($get) => $get('type') === 'pdf'),

                RichEditor::make('content')
                    ->label('Contenido del artículo')
                    ->visible(fn($get) => $get('type') === 'article'),

                RichEditor::make('content')
                    ->label('Contenido del artículo')
                    ->visible(fn($get) => $get('type') === 'article'),

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
                    ->label('Título')
                    ->searchable(),
                TextColumn::make('type')
                    ->label('Tipo')
                    ->formatStateUsing(fn($state) => match ($state) {
                        'server_video'  => '🎬 Video servidor',
                        'youtube_video' => '▶️ YouTube',
                        'pdf'           => '📄 PDF',
                        'article'       => '📝 Artículo',
                        default         => $state,
                    }),
            ])
            ->headerActions([
                CreateAction::make()->label('+ Agregar lección'),
            ])
            ->recordActions([
                EditAction::make()->label('Editar'),
                DeleteAction::make()->label('Eliminar'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('Eliminar seleccionadas'),
                ]),
            ])
            ->defaultSort('order');
    }
}
