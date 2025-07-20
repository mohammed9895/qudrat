<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use Filament\Support\Assets\Js;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentColor;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use RuntimeException;

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

        FilamentColor::register([
            'danger' => Color::Red,
            'info' => Color::Blue,
            'primary' => '#1d71b8',
            'gray' => Color::Slate,
            'success' => Color::Green,
            'warning' => Color::Amber,
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
        // Custom method to check signature correctness
        URL::macro('alternateHasCorrectSignature', function (Request $request, $absolute = true, array $ignoreQuery = []) {
            // Ensure signature is ignored in query parameters
            $ignoreQuery[] = 'signature';

            // Build the URL
            $absoluteUrl = url($request->path());
            $url = $absolute ? $absoluteUrl : '/'.$request->path();

            // Collect and filter query string parameters
            $queryString = collect(explode('&', (string) $request->server->get('QUERY_STRING')))
                ->reject(fn ($parameter) => in_array(Str::before($parameter, '='), $ignoreQuery))
                ->join('&');

            // Original URL before signing (including query parameters)
            $original = rtrim($url.'?'.$queryString, '?');

            // Use the application key to generate the signature
            $key = config('app.key'); // Ensure app.key is set in .env

            if (empty($key)) {
                throw new RuntimeException('Application key is not set.');
            }

            // Generate the signature with HMAC
            $signature = hash_hmac('sha256', $original, $key);

            // Compare the generated signature with the one provided in the query string
            return hash_equals($signature, (string) $request->query('signature', ''));
        });

        // Check if the signature is valid and not expired
        URL::macro('alternateHasValidSignature', function (Request $request, $absolute = true, array $ignoreQuery = []) {
            return URL::alternateHasCorrectSignature($request, $absolute, $ignoreQuery)
                && URL::signatureHasNotExpired($request);
        });

        // Add the valid signature method to the Request object
        Request::macro('hasValidSignature', function ($absolute = true, array $ignoreQuery = []) {
            return URL::alternateHasValidSignature($this, $absolute, $ignoreQuery);
        });
    }
}
