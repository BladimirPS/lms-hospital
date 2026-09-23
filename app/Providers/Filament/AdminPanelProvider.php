<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Filament\Admin\Pages\CustomDashboard;

use Filament\View\PanelsRenderHook;

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
            ->brandLogo(asset('img/logo-hro-blanco-horizontal.png'))
            ->discoverResources(in: app_path('Filament/Admin/Resources'), for: 'App\Filament\Admin\Resources')
            ->discoverPages(in: app_path('Filament/Admin/Pages'), for: 'App\Filament\Admin\Pages')
            ->pages([
                CustomDashboard::class,
            ])
            ->darkMode(false)
            ->sidebarCollapsibleOnDesktop()
            ->navigationItems([
                NavigationItem::make('Reportes y estadísticas')
                    ->url('/admin-reportes/reportes')
                    ->icon('heroicon-o-chart-bar')
                    ->group('Reportes')
                    ->sort(1),
            ])
            ->userMenuItems([

                'settings' => MenuItem::make()
                    ->label('Configuración del sistema')
                    ->url(fn() => '/admin/profile')

                    ->visible(fn() => auth()->user()->hasRole('superadmin')),
            ])
            ->globalSearch(true)
            ->breadcrumbs(true)
            ->renderHook(
                PanelsRenderHook::USER_MENU_BEFORE,
                fn() => view('filament.partials.role-badges', [
                    'roles' => auth()->user()?->roles ?? collect(),
                ])
            )

            ->renderHook(
                PanelsRenderHook::TOPBAR_LOGO_AFTER,
                fn() => view('filament.partials.brand-text')
            )
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
