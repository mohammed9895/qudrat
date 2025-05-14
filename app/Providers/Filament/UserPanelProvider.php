<?php

namespace App\Providers\Filament;

use App\Filament\User\Pages\Dashboard;
use App\Models\Country;
use App\Models\Profile;
use App\Models\Province;
use App\Models\State;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard\Step as WizardStep;
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
use RalphJSmit\Filament\Onboard\Http\Livewire\Wizard;
use RalphJSmit\Filament\Onboard\Http\Middleware\OnboardMiddleware;
use RalphJSmit\Filament\Onboard\Step;
use RalphJSmit\Filament\Onboard\Track;

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
                'primary' => '#1d71b8',
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
                        Step::make(name: fn () => 'Hello '.auth()->user()->name, identifier: 'Welcome to the onboarding process.')
                            ->description('Let\'s get started by filling in your basic information. and then you can complate your profile.')
                            // ->completeIf(fn () => auth()->user()->profile && auth()->user()->profile->username !== null)
                            ->cardWidth('3xl')
                            ->wizard([
                                WizardStep::make('Basic Information')
                                    ->statePath('step_1') // It is recommended to keep the form data in a separate array key for each step.
                                    ->schema([
                                        FileUpload::make('avatar')->avatar()->columnSpanFull()->label(__('general.basic-information.username')),
                                        TextInput::make('fullname')->disabled()->label(__('general.contact.full-name')),
                                        TextInput::make('position')->disabled()->label(__('general.basic-information.position')),
                                        MarkdownEditor::make('bio')->columnSpanFull()->label(__('general.basic-information.bio')),
                                        TextInput::make('username')->prefix(env('APP_URL'))->unique(table: Profile::class)->columnSpanFull()->required()->label(__('general.basic-information.username')),
                                        TextInput::make('email')->default('John')->label(__('general.basic-information.email')),
                                        TextInput::make('phone')->label(__('general.basic-information.phone')),
                                        Select::make('gender')
                                            ->label(__('general.basic-information.gender'))
                                            ->searchable()
                                            ->options([
                                                1 => __('general.gender-types.male'),
                                                0 => __('general.gender-types.female'),
                                                ])->disabled(),
                                        DatePicker::make('dob')->disabled()->format('Y-mm-dd')->label(__('general.basic-information.dob')),
                                        FileUpload::make('video')
                                            ->label(__('general.basic-information.video'))
                                            ->hint('Upload a video about your attachments.')
                                            ->columnSpanFull(),
                                    ])->columns(2),
                                WizardStep::make('Location')
                                    ->statePath('step_2') // It is recommended to keep the form data in a separate array key for each step.
                                    ->schema([
                                        Select::make('country_id')
                                            ->label(__('general.basic-information.country'))
                                            ->options(Country::all()->pluck('name', 'id'))
                                            ->searchable(),
                                        Select::make('province_id')
                                            ->label(__('general.basic-information.province'))
                                            ->options(Province::all()->pluck('name', 'id'))
                                            ->searchable()
                                            ->reactive()
                                            ->afterStateUpdated(fn (Set $set) => $set('state_id', null)),
                                        Select::make('state_id')
                                        ->label(__('general.basic-information.state'))
                                            ->options(function (Get $get) {
                                                $province = Province::find($get('province_id'));
                                                if (! $province) {
                                                    return State::all()->pluck('name', 'id');
                                                }

                                                return $province->states->pluck('name', 'id');
                                            })
                                            ->searchable(),
                                        TextInput::make('address')->label(__('general.basic-information.address')),
                                    ])->columns(2),
                            ])
                            ->wizardFillFormUsing(function() {
                                $profile = auth()->user()->profile;
                        
                                return [
                                    'step_1' => [
                                        'fullname' => $profile->fullname ?? '',
                                        'position' => $profile->position ?? '',
                                        'email' => $profile->email ?? '',
                                        'gender' => $profile->gender ?? '',
                                        'dob' => $profile->dob ?? '',
                                        'phone' => $profile->phone ?? '',
                                        'country_id' => $profile->country_id ?? '',
                                    ]
                                ];
                            })
                            ->wizardSubmitFormUsing(function (array $state, Wizard $livewire) {
                                // Save the data to the database.
                                $profile = Profile::updateOrCreate(
                                    ['user_id' => auth()->id()],
                                    array_merge($state['step_1'], $state['step_2'])
                                );
                                $livewire->redirectRoute('filament.user.pages.dashboard');
                            }),
                    ])->completeBeforeAccess())
                    ->addTrack(fn () => Track::make([
                            Step::make(name: __('general.steps.add_education'), identifier: 'widget::add-educations')
                                    ->description(__('general.steps.add_education_description'))
                                    ->icon('hugeicons-graduation-scroll')
                                    ->url(route('filament.user.profile.pages.educations'))
                                    ->completeIf(fn () => auth()->user()->profile->educations()->count() > 0),
                            Step::make(name: __('general.steps.add_experience'), identifier: 'widget::connect-experiences')
                                ->icon('hugeicons-new-job')
                                ->description(__('general.steps.add_experience_description'))
                                ->url(route('filament.user.profile.pages.experiences'))
                                ->completeIf(fn () => auth()->user()->profile->experiences()->count() > 0),

                            Step::make(__('general.steps.add_certificates'), 'widget::add-certificates')
                                ->icon('hugeicons-certificate-01')
                                ->description(__('general.steps.add_certificates_description'))
                                ->url(route('filament.user.profile.pages.certificates'))
                                ->completeIf(fn () => auth()->user()->profile->certificates()->count() > 0),

                            Step::make(__('general.steps.add_achievements'), 'widget::add-achievements')
                                ->icon('hugeicons-checkmark-square-03')
                                ->description(__('general.steps.add_achievements_description'))
                                ->url(route('filament.user.profile.pages.achievements'))
                                ->completeIf(fn () => auth()->user()->profile->achievements()->count() > 0),

                            Step::make(__('general.steps.add_courses'), 'widget::add-courses')
                                ->icon('hugeicons-course')
                                ->description(__('general.steps.add_courses_description'))
                                ->url(route('filament.user.profile.pages.courses'))
                                ->completeIf(fn () => auth()->user()->profile->courses()->count() > 0),

                            Step::make(__('general.steps.more_about_you'), 'widget::add-more-about-you')
                                ->icon('hugeicons-user-search-01')
                                ->description(__('general.steps.more_about_you_description'))
                                ->url(route('filament.user.profile.pages.more-about-you'))
                                ->completeIf(function () {
                                    if (auth()->user()->profile->skills || auth()->user()->profile->languages || auth()->user()->profile->interested || auth()->user()->profile->tools || auth()->user()->profile->categories) {
                                        return true;
                                    } else {
                                        return false;
                                    }
                                }),

                            Step::make(__('general.steps.add_social_media'), 'widget::add-social-media')
                                ->icon('hugeicons-share-08')
                                ->description(__('general.steps.add_social_media_description'))
                                ->url(route('filament.user.profile.pages.more-about-you'))
                                ->completeIf(fn () => auth()->user()->profile->achievements()->count() > 0),

                            Step::make(__('general.steps.your_privacy'), 'widget::add-privacy')
                                ->icon('hugeicons-locked')
                                ->description(__('general.steps.your_privacy_description'))
                                ->url(route('filament.user.profile.pages.more-about-you'))
                                ->completeIf(fn () => auth()->user()->profile->achievements()->count() > 0),
                ])->sequential(false)),
            ]);
    }
}
