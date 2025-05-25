<?php

use App\Http\Middleware\CorsMiddleware;
use App\Http\Middleware\LocaleMiddleware;
use App\Http\Middleware\SessionTimeout;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->appendToGroup('web', LocaleMiddleware::class);
        $middleware->append(SessionTimeout::class);
        //  $middleware->trustProxies(at: '*');
        // $middleware->append(CorsMiddleware::class)
        $middleware->trustProxies(at: '*');
         $middleware->trustProxies(headers: Request::HEADER_X_FORWARDED_FOR |
                Request::HEADER_X_FORWARDED_HOST |
                Request::HEADER_X_FORWARDED_PORT |
                Request::HEADER_X_FORWARDED_PROTO |
                Request::HEADER_X_FORWARDED_AWS_ELB
            );
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
