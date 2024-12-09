<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfilePrivacy
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $profile = $request->route('profile');
        // Check if the profile exists and is public
        if (!$profile || !$profile->is_public) {
            abort(403, 'This profile is not public.');
        }
        return $next($request);
    }
}
