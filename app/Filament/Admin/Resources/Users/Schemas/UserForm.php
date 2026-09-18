<?php

namespace App\Filament\Admin\Resources\Users\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('system_code')
                    ->required(),
                TextInput::make('hospital_code'),
                TextInput::make('first_name')
                    ->required(),
                TextInput::make('middle_name'),
                TextInput::make('third_name'),
                TextInput::make('last_name')
                    ->required(),
                TextInput::make('second_last_name'),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('password')
                    ->password()
                    ->required(),
                DateTimePicker::make('email_verified_at'),
                TextInput::make('profile_photo'),
                FileUpload::make('signature_image')
                    ->image(),
                DatePicker::make('hire_date'),
                TextInput::make('position'),
                TextInput::make('phone')
                    ->tel(),
                Select::make('section_id')
                    ->relationship('section', 'name'),
                Toggle::make('active')
                    ->required(),
                DateTimePicker::make('invitation_sent_at'),
                DateTimePicker::make('last_access_at'),
            ]);
    }
}
