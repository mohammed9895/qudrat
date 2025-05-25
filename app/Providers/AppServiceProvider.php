<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        FilamentAsset::register([
            Js::make('app', Vite::asset('resources/js/app.js'))->module(),
        ]);

        //        Vite::useBuildDirectory('/public');

        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->locales(['ar', 'en']); // also accepts a closure
        });

        Blade::directive('isRoute', function ($route_name) {
            return "<?php if (Route::is('{$route_name}')): ?>";
        });

        Blade::directive('elseIsRoute', function () {
            return '<?php else: ?>';
        });

        Blade::directive('endIsRoute', function () {
            return '<?php endif; ?>';
        });

        User::observe(UserObserver::class);

        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }

        EncryptCookies::except('AUTH_COOKIE');

    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
}
