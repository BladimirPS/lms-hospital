<?php

namespace App\Filament\Admin\Resources\Courses\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ExamRelationManager extends RelationManager
{
    protected static string $relationship = 'exam';
    protected static ?string $title = 'Evaluación del curso';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Repeater::make('questions')
                    ->label('Preguntas del examen')
                    ->relationship('questions')
                    ->addActionLabel('+ Agregar pregunta')

                    ->collapsible()
->collapsed()
    ->itemLabel(fn (array $state): ?string =>
        $state['text'] ? 'Pregunta: ' . str($state['text'])->limit(50) : 'Nueva pregunta'
    )
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('text')
                            ->label('Enunciado de la pregunta')
                            ->required()
                            ->columnSpanFull(),

                        Grid::make(2)
                            ->schema([
                                Select::make('type')
                                    ->label('Tipo de pregunta')
                                    ->options([
                                        'true_false'      => 'Verdadero / Falso',
                                        'single_answer'   => 'Respuesta correcta',
                                        'multiple_choice' => 'Opción múltiple',
                                    ])
                                    ->required()
                                    ->live(),

                                TextInput::make('order')
                                    ->label('Orden')
                                    ->numeric()
                                    ->default(0),
                            ]),

                        FileUpload::make('image')
                            ->label('Imagen adjunta (opcional)')
                            ->image()
                            ->directory('questions/images')
                            ->nullable()
                            ->columnSpanFull(),

                        Repeater::make('options')
                            ->label('Opciones de respuesta')
                            ->relationship('options')
                            ->addActionLabel('+ Agregar opción')
                            ->minItems(2)
                            ->columnSpanFull()
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('text')
                                            ->label('Texto de la opción')
                                            ->required(),
                                        Toggle::make('is_correct')
                                            ->label('Es correcta')
                                            ->default(false),
                                    ]),
                            ])
                            ->visible(fn($get) => in_array($get('type'), [
                                'true_false',
                                'single_answer',
                                'multiple_choice',
                            ])),
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('questions_count')
                    ->label('Total de preguntas')
                    ->counts('questions'),
                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y')
                    ->sortable(),
            ])
            ->recordActions([
                EditAction::make()->label('Editar evaluación'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
