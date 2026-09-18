<?php

namespace App\Filament\Admin\Resources\Diplomas\Pages;

use App\Filament\Admin\Resources\Diplomas\DiplomaResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditDiploma extends EditRecord
{
    protected static string $resource = DiplomaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
