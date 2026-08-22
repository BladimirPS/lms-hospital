<?php

namespace App\Filament\Admin\Resources\Users\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('system_code'),
                TextEntry::make('hospital_code')
                    ->placeholder('-'),
                TextEntry::make('first_name'),
                TextEntry::make('middle_name')
                    ->placeholder('-'),
                TextEntry::make('third_name')
                    ->placeholder('-'),
                TextEntry::make('last_name'),
                TextEntry::make('second_last_name')
                    ->placeholder('-'),
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('email_verified_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('profile_photo')
                    ->placeholder('-'),
                ImageEntry::make('signature_image')
                    ->placeholder('-'),
                TextEntry::make('hire_date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('position')
                    ->placeholder('-'),
                TextEntry::make('phone')
                    ->placeholder('-'),
                TextEntry::make('section_id')
                    ->numeric()
                    ->placeholder('-'),
                IconEntry::make('active')
                    ->boolean(),
                TextEntry::make('invitation_sent_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('last_access_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
