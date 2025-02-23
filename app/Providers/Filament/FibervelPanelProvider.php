<?php

namespace App\Providers\Filament;

namespace App\Providers\Filament;

use Althinect\FilamentSpatieRolesPermissions\FilamentSpatieRolesPermissionsPlugin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\UserMenuItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class FibervelPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('fibervel')
            ->path('fibervel')
            ->login()
            ->passwordReset()
            ->emailVerification()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->unsavedChangesAlerts()
            ->sidebarCollapsibleOnDesktop()
            ->discoverResources(in: base_path('Modules'), for: 'Modules')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->plugin(FilamentSpatieRolesPermissionsPlugin::make())
            //->plugin(ModulesPlugin::make())
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }

    public function userMenuItems(): array
    {
        return [
            UserMenuItem::make()
                ->label(auth()->user()?->getActiveCompany()->name ?? 'No Company')
                ->icon('heroicon-o-building-office')
                ->url(route('company.switch')),
        ];
    }
}
