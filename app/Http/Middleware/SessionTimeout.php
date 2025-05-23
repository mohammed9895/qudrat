<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SessionTimeout
{
    protected $timeout = 1800; // 30 minutes in seconds

    public function handle($request, Closure $next)
    {

        if (Auth::check()) {
            $lastActivity = Session::get('lastActivityTime');
            if ($lastActivity && (time() - $lastActivity > $this->timeout)) {
                Auth::logout();
                Session::flush();

                return redirect('/')->withErrors(['message' => 'Session expired due to inactivity.']);
            }
            Session::put('lastActivityTime', time());
        }

        return $next($request);
    }
}
