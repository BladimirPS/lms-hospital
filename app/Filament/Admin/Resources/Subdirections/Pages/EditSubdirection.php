<?php

namespace App\Filament\Admin\Resources\Subdirections\Pages;

use App\Filament\Admin\Resources\Subdirections\SubdirectionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditSubdirection extends EditRecord
{
    protected static string $resource = SubdirectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
