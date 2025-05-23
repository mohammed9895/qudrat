<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CorsMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        return $response->withHeaders([
            'Access-Control-Allow-Origin' => 'https://qudrat_uat.mol.gov.om', // 🔄 change to your domain
            'Access-Control-Allow-Credentials' => 'true',
            'Access-Control-Allow-Methods' => 'GET, POST, OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Headers' => 'Origin, Content-Type, Accept, Authorization, X-Requested-With',
        ]);
    }
}
