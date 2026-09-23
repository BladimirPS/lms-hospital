<?php

namespace App\Filament\Admin\Resources\Users\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Datos personales')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('first_name')
                                    ->label('Primer nombre')
                                    ->required(),
                                TextInput::make('middle_name')
                                    ->label('Segundo nombre'),
                                TextInput::make('third_name')
                                    ->label('Tercer nombre'),
                                TextInput::make('last_name')
                                    ->label('Primer apellido')
                                    ->required(),
                                TextInput::make('second_last_name')
                                    ->label('Segundo apellido'),
                                TextInput::make('phone')
                                    ->label('Teléfono')
                                    ->tel(),
                            ]),
                    ]),

                Section::make('Datos institucionales')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('system_code')
                                    ->label('Código del sistema')
                                    ->disabled()
                                    ->dehydrated(false)
                                    ->placeholder('Generado automáticamente')
                                    ->helperText('El sistema asigna este código automáticamente.'),
                                TextInput::make('hospital_code')
                                    ->label('Código del hospital'),
                                Select::make('section_id')
                                    ->label('Sección')
                                    ->relationship('section', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->live(),

                                Select::make('position_id')
                                    ->label('Puesto')
                                    ->options(function ($get) {
                                        $sectionId = $get('section_id');
                                        if (!$sectionId) {
                                            return [];
                                        }
                                        return \App\Models\Position::where('section_id', $sectionId)
                                            ->pluck('name', 'id');
                                    })
                                    ->searchable()
                                    ->label('Puesto')
                                    ->helperText('Seleccione primero una sección.'),

                                Select::make('budget_line_id')
                                    ->label('Renglón presupuestario')
                                    ->relationship('budgetLine', 'name')
                                    ->getOptionLabelFromRecordUsing(fn($record) => "{$record->code} — {$record->name}")
                                    ->searchable()
                                    ->preload(),
                                Toggle::make('active')
                                    ->label('Usuario activo')
                                    ->default(true),
                            ]),
                    ]),

                Section::make('Acceso al sistema')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('email')
                                    ->label('Correo electrónico')
                                    ->email()
                                    ->required(),
                                TextInput::make('password')
                                    ->label('Contraseña')
                                    ->password()
                                    ->dehydrated(fn($state) => filled($state))
                                    ->required(fn(string $operation): bool => $operation === 'create')
                                    ->helperText('Dejar en blanco para mantener la contraseña actual.'),
                            ]),
                        Select::make('roles')
                            ->label('Rol')
                            ->multiple()
                            ->relationship('roles', 'name')
                            ->getOptionLabelFromRecordUsing(fn($record) => match ($record->name) {
                                'superadmin' => 'Superadministrador',
                                'encargado'  => 'Encargado de Departamento',
                                'estudiante' => 'Estudiante',
                                default      => $record->name,
                            })
                            ->preload()
                            ->required(),
                    ]),

                Section::make('Imágenes')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                FileUpload::make('profile_photo')
                                    ->label('Foto de perfil')
                                    ->image()
                                    ->directory('users/photos'),
                                FileUpload::make('signature_image')
                                    ->label('Imagen de firma')
                                    ->image()
                                    ->directory('users/signatures'),
                            ]),
                    ]),



            ]);
    }
}
