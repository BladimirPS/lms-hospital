<?php

namespace App\Filament\Admin\Pages;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class EditProfile extends Page implements HasForms
{
    use InteractsWithForms;

    protected static bool $shouldRegisterNavigation = false;

    protected string $view = 'filament.admin.pages.edit-profile';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(auth()->user()->only([
            'first_name', 'middle_name', 'third_name', 'last_name', 'second_last_name', 'email', 'phone',
        ]));
    }

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('first_name')->label('Primer nombre')->required(),
            TextInput::make('middle_name')->label('Segundo nombre'),
            TextInput::make('third_name')->label('Tercer nombre'),
            TextInput::make('last_name')->label('Primer apellido')->required(),
            TextInput::make('second_last_name')->label('Segundo apellido'),
            TextInput::make('email')->label('Correo')->email()->required(),
            TextInput::make('phone')->label('Teléfono')->tel(),

            TextInput::make('current_password')
                ->label('Contraseña actual')
                ->password()
                ->revealable()
                ->dehydrated(false)
                ->requiredWith('password')
                ->rule(function () {
                    return function (string $attribute, $value, \Closure $fail) {
                        if (filled($value) && ! Hash::check($value, auth()->user()->password)) {
                            $fail('La contraseña actual no es correcta.');
                        }
                    };
                })
                ->helperText('Requerida solo si querés cambiar la contraseña.'),

            TextInput::make('password')
                ->label('Nueva contraseña')
                ->password()
                ->revealable()
                ->dehydrated(fn ($state) => filled($state))
                ->confirmed()
                ->helperText('Dejar en blanco para no cambiar la contraseña actual.'),

            TextInput::make('password_confirmation')
                ->label('Confirmar nueva contraseña')
                ->password()
                ->revealable()
                ->dehydrated(false)
                ->requiredWith('password'),
        ])->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        if (blank($data['password'] ?? null)) {
            unset($data['password']);
        }

        auth()->user()->update($data);

        Notification::make()
            ->title('Perfil actualizado')
            ->success()
            ->send();
    }
}
