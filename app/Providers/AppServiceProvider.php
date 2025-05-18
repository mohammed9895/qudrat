<?php

namespace App\Providers;

use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\UserRegistered;
use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\URL;
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

        // if (env('APP_ENV') !== 'local') {
        //     URL::forceScheme('https');
        // }


    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
}
