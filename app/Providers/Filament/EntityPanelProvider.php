<?php

namespace App\Providers\Filament;

use App\Models\Entity;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard\Step as WizardStep;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\SpatieLaravelTranslatablePlugin;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use RalphJSmit\Filament\Onboard\FilamentOnboard;
use RalphJSmit\Filament\Onboard\Http\Livewire\Wizard;
use RalphJSmit\Filament\Onboard\Http\Middleware\OnboardMiddleware;
use RalphJSmit\Filament\Onboard\Step;
use RalphJSmit\Filament\Onboard\Track;

class EntityPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('entity')
            ->path('entity')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->colors([
                'primary' => '#1d71b8',
                'gray' => Color::Slate,
            ])
            ->brandLogo(asset('assets/images/logo.svg'))
            ->discoverResources(in: app_path('Filament/Entity/Resources'), for: 'App\\Filament\\Entity\\Resources')
            ->discoverPages(in: app_path('Filament/Entity/Pages'), for: 'App\\Filament\\Entity\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Entity/Widgets'), for: 'App\\Filament\\Entity\\Widgets')
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
                OnboardMiddleware::class,
            ])
            ->plugins([
                SpatieLaravelTranslatablePlugin::make()->defaultLocales(['ar', 'en']),
                FilamentOnboard::make()
                    ->addTrack(fn () => Track::make([
                        Step::make(name: fn () => 'Hello '.auth()->user()->name, identifier: 'Welcome to the onboarding process.')
                            ->description('Let\'s get started by filling in your basic information. and then you can complate your profile.')
                            ->completeIf(fn () => auth()->user()->entity()->exists())
                            ->cardWidth('3xl')
                            ->wizard([
                                WizardStep::make('Basic Information')
                                    ->statePath('step_1') // It is recommended to keep the form data in a separate array key for each step.
                                    ->schema([
                                        TextInput::make('name')->label('Organization Name')->columnSpanFull(),
                                        RichEditor::make('description')->columnSpanFull(),
                                        FileUpload::make('logo')->columnSpanFull(),
                                    ])->columns(2),
                                WizardStep::make('Contact Information')
                                    ->statePath('step_2') // It is recommended to keep the form data in a separate array key for each step.
                                    ->schema([
                                        TextInput::make('email'),
                                        TextInput::make('phone'),
                                        TextInput::make('address'),
                                    ])->columns(2),
                            ])
                            ->wizardSubmitFormUsing(function (array $state, Wizard $livewire) {
                                // Save the data to the database.
                                $profile = Entity::updateOrCreate(
                                    ['user_id' => auth()->id()],
                                    array_merge($state['step_1'], $state['step_2'])
                                );
                                $livewire->redirectRoute('filament.entity.pages.dashboard');
                            }),
                    ])->completeBeforeAccess()),
            ]);
    }
}
