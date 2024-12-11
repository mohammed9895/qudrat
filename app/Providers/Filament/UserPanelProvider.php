<?php

namespace App\Providers\Filament;

use App\Filament\User\Clusters\Profile\Pages\Educations;
use App\Filament\User\Pages\Dashboard;
use App\Models\Country;
use App\Models\Province;
use App\Models\State;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use JaOcero\FilaChat\FilaChatPlugin;
use RalphJSmit\Filament\Onboard\FilamentOnboard;
use RalphJSmit\Filament\Onboard\Http\Middleware\OnboardMiddleware;
use RalphJSmit\Filament\Onboard\Step;
use RalphJSmit\Filament\Onboard\Track;
use Filament\Forms\Components\Wizard\Step as WizardStep;

class UserPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('user')
            ->path('user')
            ->login()
            ->registration()
            ->colors([
                'primary' => '#3cc7bc',
                'gray' => Color::Slate,
            ])
            ->brandLogo(asset('assets/images/logo.svg'))
            ->discoverResources(in: app_path('Filament/User/Resources'), for: 'App\\Filament\\User\\Resources')
            ->discoverPages(in: app_path('Filament/User/Pages'), for: 'App\\Filament\\User\\Pages')
            ->discoverClusters(in: app_path('Filament/User/Clusters'), for: 'App\\Filament\\User\\Clusters')
            ->topNavigation()
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/User/Widgets'), for: 'App\\Filament\\USER\\Widgets')
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
            ->viteTheme('resources/css/filament/user/theme.css')
            ->plugins([
                FilaChatPlugin::make(),
                FilamentOnboard::make()
                    ->addTrack(fn () => Track::make([
                        Step::make(name: fn () => 'Hello ' . auth()->user()->name, identifier: 'Welcome to the onboarding process.')
                            ->description('Let\'s get started by filling in your basic information. and then you can complate your profile.')
                            ->completeIf(fn() => auth()->user()->profile()->exists())
                            ->cardWidth('3xl')
                            ->wizard([
                                WizardStep::make("Basic Information")
                                    ->statePath('step_1') // It is recommended to keep the form data in a separate array key for each step.
                                    ->schema([
                                        FileUpload::make('avatar')->avatar()->columnSpanFull(),
                                        TextInput::make('fullname'),
                                        TextInput::make('position'),
                                        MarkdownEditor::make('bio')->columnSpanFull(),
                                        TextInput::make('username')->prefix('https://qudrat.om/')->columnSpanFull(),
                                        TextInput::make('email'),
                                        TextInput::make('phone'),
                                        Select::make('gender')
                                            ->searchable()
                                            ->options(['Male', 'Female']),
                                        DatePicker::make('dob')->native(false),
                                        FileUpload::make('video')
                                            ->hint('Upload a video about your attachments.')
                                            ->columnSpanFull(),
                                    ])->columns(2),
                                WizardStep::make("Location")
                                    ->statePath('step_2') // It is recommended to keep the form data in a separate array key for each step.
                                    ->schema([
                                        Select::make('country_id')
                                            ->label('Country')
                                            ->options(Country::all()->pluck('name', 'id'))
                                            ->searchable(),
                                        Select::make('province_id')
                                            ->label(__('Province'))
                                            ->options(Province::all()->pluck('name', 'id'))
                                            ->searchable()
                                            ->reactive()
                                            ->afterStateUpdated(fn(Set $set) => $set('state_id', null)),
                                        Select::make('state_id')
                                            ->label(__('State'))
                                            ->options(function (Get $get) {
                                                $province = Province::find($get('province_id'));
                                                if (!$province) {
                                                    return State::all()->pluck('name', 'id');
                                                }
                                                return $province->states->pluck('name', 'id');
                                            })
                                            ->searchable(),
                                        TextInput::make('address'),
                                    ])->columns(2),
                            ])
                            ->wizardSubmitFormUsing(function(array $state, \RalphJSmit\Filament\Onboard\Http\Livewire\Wizard $livewire) {
                                // Save the data to the database.
                                $profile = \App\Models\Profile::updateOrCreate(
                                    ['user_id' => auth()->id()],
                                    array_merge($state['step_1'], $state['step_2'])
                                );
                                $livewire->redirectRoute('filament.user.pages.dashboard');
                            }),
                    ])->completeBeforeAccess())
                    ->addTrack(fn () => Track::make([
                        Step::make(name: 'Add Eduction', identifier: 'widget::add-educations')
                            ->description('Add your education information.')
                            ->icon('hugeicons-graduation-scroll')
                            ->url(route('filament.user.profile.pages.educations'))
                            ->completeIf(fn() => auth()->user()->profile->educations()->count() > 0),
                        Step::make(name: 'Add Experience', identifier: 'widget::connect-experiences')
                            ->description('Add your experiences information.')
                            ->icon('hugeicons-new-job')
                            ->url(route('filament.user.profile.pages.experiences'))
                            ->completeIf(fn() => auth()->user()->profile->experiences()->count() > 0),
                        Step::make('Add Certificates', 'widget::add-certificates')
                            ->description('Add your certificates information.')
                            ->icon('hugeicons-certificate-01')
                            ->url(route('filament.user.profile.pages.certificates'))
                            ->completeIf(fn() => auth()->user()->profile->certificates()->count() > 0),
                        Step::make('Add Achievements', 'widget::add-achievements')
                            ->description('Add your achievements information.')
                            ->icon('hugeicons-checkmark-square-03')
                            ->url(route('filament.user.profile.pages.achievements'))
                            ->completeIf(fn() => auth()->user()->profile->achievements()->count() > 0),
                        Step::make('Add Courses', 'widget::add-courses')
                            ->description('Add your courses information.')
                            ->icon('hugeicons-course')
                            ->url(route('filament.user.profile.pages.courses'))
                            ->completeIf(fn() => auth()->user()->profile->courses()->count() > 0),
                        Step::make('More About You', 'widget::add-more-about-you')
                            ->description('Add more information about you.')
                            ->icon('hugeicons-user-search-01')
                            ->url(route('filament.user.profile.pages.more-about-you'))
                            ->completeIf(function () {
                                if (auth()->user()->profile->skills || auth()->user()->profile->languages || auth()->user()->profile->interested || auth()->user()->profile->tools || auth()->user()->profile->categories) {
                                    return true;
                                }
                                else {
                                    return false;
                                }
                            }),
                        Step::make('Add Social Media', 'widget::add-social-media')
                            ->description('Add you social media links.')
                            ->icon('hugeicons-share-08')
                            ->url(route('filament.user.profile.pages.more-about-you'))
                            ->completeIf(fn() => auth()->user()->profile->achievements()->count() > 0),
                        Step::make('Your Privacy', 'widget::add-privacy')
                            ->description('Choose where you want to be public or no.')
                            ->icon('hugeicons-locked')
                            ->url(route('filament.user.profile.pages.more-about-you'))
                            ->completeIf(fn() => auth()->user()->profile->achievements()->count() > 0),
                ])->sequential(false)),
            ]);
    }
}
