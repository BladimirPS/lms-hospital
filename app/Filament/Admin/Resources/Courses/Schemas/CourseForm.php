<?php

namespace App\Filament\Admin\Resources\Courses\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CourseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                FileUpload::make('cover_image')
                    ->image(),
                TextInput::make('type')
                    ->required(),
                TextInput::make('version')
                    ->required()
                    ->numeric()
                    ->default(1),
                Select::make('parent_version_id')
                    ->relationship('parentVersion', 'title'),
                Toggle::make('is_free_choice')
                    ->required(),
                Toggle::make('generates_diploma')
                    ->required(),
                TextInput::make('minimum_score')
                    ->required()
                    ->numeric()
                    ->default(70),
                DatePicker::make('start_date'),
                DatePicker::make('due_date'),
                TextInput::make('status')
                    ->required()
                    ->default('draft'),
                Select::make('creator_id')
                    ->relationship('creator', 'id')
                    ->required(),
            ]);
    }
}
