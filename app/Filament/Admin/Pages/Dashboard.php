<?php

namespace App\Filament\Admin\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationLabel = 'Inicio';

    public function getTitle(): string
    {
        return 'Panel de administración';
    }

    public function getHeading(): string
    {
        return 'Bienvenido al LMS del Hospital Regional de Occidente';
    }

    public function getSubheading(): ?string
    {
        return 'Sistema de gestión de aprendizaje';
    }
}
