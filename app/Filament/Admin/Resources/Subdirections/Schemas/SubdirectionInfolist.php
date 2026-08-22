<?php

namespace App\Filament\Admin\Resources\Subdirections\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SubdirectionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
