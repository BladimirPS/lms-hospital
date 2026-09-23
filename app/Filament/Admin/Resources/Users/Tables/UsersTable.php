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
                ->label('Código del sistema')
                    ->searchable(),
                TextColumn::make('hospital_code')
                    ->label('Código del hospital')
                    ->searchable(),
                TextColumn::make('first_name')
                    ->label('Nombre')
                    ->searchable(),
                TextColumn::make('middle_name')
                    ->label('Segundo nombre')
                    ->searchable(),
                TextColumn::make('third_name')
                    ->label('Tercer nombre')
                    ->searchable(),
                TextColumn::make('last_name')
                    ->label('Apellido paterno')
                    ->searchable(),
                TextColumn::make('second_last_name')
                    ->label('Apellido materno')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Correo Electrónico')
                    ->searchable(),
                TextColumn::make('email_verified_at')
                ->label('Correo verificado')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('profile_photo')
                ->label('Foto de perfil')
                    ->searchable(),
                ImageColumn::make('signature_image')
                    ->label('Firma'),
                TextColumn::make('hire_date')
                ->label('Fecha de contratación')
                    ->date()
                    ->sortable(),
                TextColumn::make('position.name')
                    ->label('Puesto')
                    ->searchable(),
                TextColumn::make('phone')
                    ->label('Teléfono')
                    ->searchable(),
                TextColumn::make('section.name')
                    ->label('Sección')
                    ->searchable(),
                IconColumn::make('active')
                ->label('Estado')
                    ->boolean(),
                TextColumn::make('invitation_sent_at')
                    ->label('Invitación enviada')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('last_access_at')
                    ->label('Último acceso')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Creado el')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Actualizado el')
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
