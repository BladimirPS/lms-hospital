<?php

namespace App\Filament\Admin\Resources\Users\Schemas;

use App\Models\Section as SectionModel;
use App\Models\Subdirection;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Identificación')
                    ->columns(2)
                    ->components([
                        TextInput::make('system_code')
                            ->label('Código de sistema')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(50),

                        TextInput::make('hospital_code')
                            ->label('Código de hospital')
                            ->maxLength(50),
                    ]),

                Section::make('Nombre completo')
                    ->description('Según el formato de nombres del hospital')
                    ->columns(2)
                    ->components([
                        TextInput::make('first_name')
                            ->label('Primer nombre')
                            ->required()
                            ->maxLength(100),

                        TextInput::make('middle_name')
                            ->label('Segundo nombre')
                            ->maxLength(100),

                        TextInput::make('third_name')
                            ->label('Tercer nombre')
                            ->maxLength(100),

                        TextInput::make('last_name')
                            ->label('Primer apellido')
                            ->required()
                            ->maxLength(100),

                        TextInput::make('second_last_name')
                            ->label('Segundo apellido')
                            ->maxLength(100),
                    ]),

                Section::make('Cuenta y acceso')
                    ->columns(2)
                    ->components([
                        TextInput::make('email')
                            ->label('Correo electrónico')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        TextInput::make('password')
                            ->label('Contraseña')
                            ->password()
                            ->revealable()
                            ->required(fn (string $operation): bool => $operation === 'create')
                            ->minLength(8)
                            ->dehydrated(fn (?string $state): bool => filled($state))
                            ->dehydrateStateUsing(fn (string $state): string => Hash::make($state)),

                        Select::make('roles')
                            ->label('Roles')
                            ->relationship('roles', 'name')
                            ->multiple()
                            ->preload()
                            ->searchable(),

                        Toggle::make('active')
                            ->label('Activo')
                            ->default(true),
                    ]),

                Section::make('Datos laborales')
                    ->columns(2)
                    ->components([
                        Select::make('subdirection_id')
                            ->label('Subdirección')
                            ->options(fn () => Subdirection::query()->orderBy('name')->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateHydrated(function (Set $set, $record) {
                                $set('subdirection_id', $record?->section?->subdirection_id);
                            })
                            ->afterStateUpdated(fn (Set $set) => $set('section_id', null))
                            ->dehydrated(false),

                        Select::make('section_id')
                            ->label('Sección')
                            ->options(function (Get $get) {
                                $subdirectionId = $get('subdirection_id');

                                return SectionModel::query()
                                    ->when($subdirectionId, fn ($query) => $query->where('subdirection_id', $subdirectionId))
                                    ->orderBy('name')
                                    ->pluck('name', 'id');
                            })
                            ->searchable()
                            ->preload()
                            ->live(),

                        TextInput::make('position')
                            ->label('Puesto')
                            ->maxLength(150),

                        TextInput::make('phone')
                            ->label('Teléfono')
                            ->tel()
                            ->maxLength(20),

                        DatePicker::make('hire_date')
                            ->label('Fecha de contratación')
                            ->native(false),
                    ]),
            ]);
    }
}
