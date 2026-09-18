<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('admin')
            ->path('admin')
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->colors([
                'primary' => '#1A3A5C',
            ])
            ->brandName('Sistema LMS — HRO')
            ->favicon(public_path('favicon.ico'))
            ->brandlogo(asset('img/logo-hro-blanco-horizontal.png'))
            ->discoverResources(in: app_path('Filament/Admin/Resources'), for: 'App\Filament\Admin\Resources')
            ->discoverPages(in: app_path('Filament/Admin/Pages'), for: 'App\Filament\Admin\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Admin/Widgets'), for: 'App\Filament\Admin\Widgets')
            ->userMenuItems([
    'profile' => MenuItem::make()
        ->label('Mi perfil')
        ->url(fn () => \App\Filament\Admin\Pages\EditProfile::getUrl())
        ->icon('heroicon-o-user-circle'),

    'settings' => MenuItem::make()
        ->label('Configuración del sistema')
        ->url(fn () => '/admin/profile')
        ->icon('heroicon-o-cog-6-tooth')
        ->visible(fn () => auth()->user()->hasRole('superadmin')),
])

            // --- Notificaciones (campana en el topbar) ---
            //->databaseNotifications()
            //->databaseNotificationsPolling('30s')

            // --- Buscador global ---
            ->globalSearch(true)

            // --- Breadcrumbs ---
            ->breadcrumbs(true)

            // --- Menú desplegable de usuario ---
            ->userMenuItems([
                'settings' => MenuItem::make()
                    ->label('Configuración del sistema')
                    ->url(fn () => '/admin/profile') // ajustar cuando exista la SettingsPage
                    ->icon('heroicon-o-cog-6-tooth')
                    ->visible(fn () => auth()->user()->hasRole('superadmin')),
            ])

            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->plugins([
                FilamentShieldPlugin::make(),
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
