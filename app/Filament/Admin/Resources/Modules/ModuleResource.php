<?php

namespace App\Filament\Admin\Resources\Modules;

use App\Filament\Admin\Resources\Modules\Pages\CreateModule;
use App\Filament\Admin\Resources\Modules\Pages\EditModule;
use App\Filament\Admin\Resources\Modules\Pages\ListModules;
use App\Filament\Admin\Resources\Modules\Schemas\ModuleForm;
use App\Filament\Admin\Resources\Modules\Tables\ModulesTable;
use App\Models\Module;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use App\Filament\Admin\Resources\Modules\RelationManagers\LessonsRelationManager;
use App\Filament\Clusters\CourseManagement\CourseManagementCluster;


class ModuleResource extends Resource
{
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $model = Module::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
protected static ?string $slug = 'modulos';
    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return ModuleForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ModulesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            LessonsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListModules::route('/'),
            'create' => CreateModule::route('/crear'),
            'edit' => EditModule::route('/{record}/editar'),
        ];
    }
}
