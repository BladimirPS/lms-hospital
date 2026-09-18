<?php

namespace App\Filament\Admin\Resources\Diplomas\Pages;

use App\Filament\Admin\Resources\Diplomas\DiplomaResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewDiploma extends ViewRecord
{
    protected static string $resource = DiplomaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
