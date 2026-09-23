<?php

namespace App\Filament\Clusters\CourseManagement;

use BackedEnum;
use Filament\Clusters\Cluster;
use Filament\Support\Icons\Heroicon;

class CourseManagementCluster extends Cluster
{
    protected static ?string $navigationLabel = 'Gestión de Cursos';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAcademicCap;
    protected static ?string $slug = 'gestion-cursos';
    protected static ?int $navigationSort = 1;
}
