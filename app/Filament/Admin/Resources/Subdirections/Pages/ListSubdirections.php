<?php

namespace App\Filament\Admin\Resources\Subdirections\Pages;

use App\Filament\Admin\Resources\Subdirections\SubdirectionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSubdirections extends ListRecords
{
    protected static string $resource = SubdirectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
