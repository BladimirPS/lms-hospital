<?php

namespace App\Filament\Admin\Resources\Subdirections\Pages;

use App\Filament\Admin\Resources\Subdirections\SubdirectionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSubdirection extends ViewRecord
{
    protected static string $resource = SubdirectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
