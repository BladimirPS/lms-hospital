<?php

namespace App\Filament\Admin\Resources\Diplomas;

use App\Filament\Admin\Resources\Diplomas\Pages\CreateDiploma;
use App\Filament\Admin\Resources\Diplomas\Pages\EditDiploma;
use App\Filament\Admin\Resources\Diplomas\Pages\ListDiplomas;
use App\Filament\Admin\Resources\Diplomas\Pages\ViewDiploma;
use App\Filament\Admin\Resources\Diplomas\Schemas\DiplomaForm;
use App\Filament\Admin\Resources\Diplomas\Schemas\DiplomaInfolist;
use App\Filament\Admin\Resources\Diplomas\Tables\DiplomasTable;
use App\Models\Diploma;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DiplomaResource extends Resource
{
    protected static ?string $model = Diploma::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Diplomas';
    protected static ?string $modelLabel = 'Diploma';
protected static ?string $pluralModelLabel = 'Diplomas';
protected static ?string $navigationLabel = 'Diplomas';

    public static function form(Schema $schema): Schema
    {
        return DiplomaForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DiplomaInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DiplomasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDiplomas::route('/'),
            'create' => CreateDiploma::route('/create'),
            'view' => ViewDiploma::route('/{record}'),
            'edit' => EditDiploma::route('/{record}/edit'),
        ];
    }
}
