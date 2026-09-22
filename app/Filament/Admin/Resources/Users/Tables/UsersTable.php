<?php

namespace App\Filament\Admin\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Services\InvitationService;
use Filament\Actions\Action;



class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('system_code')
                    ->searchable(),
                TextColumn::make('hospital_code')
                    ->searchable(),
                TextColumn::make('first_name')
                    ->searchable(),
                TextColumn::make('middle_name')
                    ->searchable(),
                TextColumn::make('third_name')
                    ->searchable(),
                TextColumn::make('last_name')
                    ->searchable(),
                TextColumn::make('second_last_name')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('profile_photo')
                    ->searchable(),
                ImageColumn::make('signature_image'),
                TextColumn::make('hire_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('position')
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
                TextColumn::make('section.name')
                    ->searchable(),
                IconColumn::make('active')
                    ->boolean(),
                TextColumn::make('invitation_sent_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('last_access_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('reenviar_invitacion')
                    ->label('Reenviar invitación')
                    ->icon('heroicon-o-envelope')
                    ->color('info')
                    ->requiresConfirmation()
                    ->modalHeading('Reenviar invitación')
                    ->modalDescription('¿Está seguro que desea reenviar el correo de invitación a este usuario?')
                    ->action(fn($record) => app(InvitationService::class)->send($record))
                    ->visible(fn($record) => !$record->active),

            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
