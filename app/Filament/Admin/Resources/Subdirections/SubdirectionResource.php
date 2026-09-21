<?php

namespace App\Filament\Admin\Resources\Subdirections;

use App\Filament\Admin\Resources\Subdirections\Pages\CreateSubdirection;
use App\Filament\Admin\Resources\Subdirections\Pages\EditSubdirection;
use App\Filament\Admin\Resources\Subdirections\Pages\ListSubdirections;
use App\Filament\Admin\Resources\Subdirections\Pages\ViewSubdirection;
use App\Filament\Admin\Resources\Subdirections\Schemas\SubdirectionForm;
use App\Filament\Admin\Resources\Subdirections\Schemas\SubdirectionInfolist;
use App\Filament\Admin\Resources\Subdirections\Tables\SubdirectionsTable;
use App\Models\Subdirection;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SubdirectionResource extends Resource
{
    protected static ?string $model = Subdirection::class;
    protected static ?string $modelLabel = 'Subdirección';
protected static ?string $pluralModelLabel = 'Subdirecciones';
protected static ?string $navigationLabel = 'Subdirecciones';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Subdireccion';

    public static function form(Schema $schema): Schema
    {
        return SubdirectionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SubdirectionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SubdirectionsTable::configure($table);
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
            'index' => ListSubdirections::route('/'),
            'create' => CreateSubdirection::route('/create'),
            'view' => ViewSubdirection::route('/{record}'),
            'edit' => EditSubdirection::route('/{record}/edit'),
        ];
    }
}
