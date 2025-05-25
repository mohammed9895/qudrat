<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandleSsoLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // 1. Check if the user is already logged in, if so, just proceed
        if (Auth::check()) {
            return $next($request);
        }

        // 2. Get token from query or cookie
        $token = strtok($request->cookie('AUTH_COOKIE'), '|');

        if (! $token) {
            Log::error('No token found in cookie');
            return redirect('/login')->withErrors('No token received.');
        }

        try {
            // 3. Call GetPrincipal with Basic Auth
            $username = 'eJWTUserName';
            $password = 'eP@ssw0rd@123abc';
            $basicAuth = base64_encode("$username:$password");

            $principalResponse = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ' . $basicAuth,
            ])->post('http://10.153.25.11/sso.token.api/api/Token/GetPrincipal', [
                'Token' => $token
            ]);

            if ($principalResponse->failed()) {
                Log::error('API Request Failed', [
                    'status' => $principalResponse->status(),
                    'body' => $principalResponse->body(),
                    'headers' => $principalResponse->headers(),
                ]);
                return redirect('/login')->withErrors('Failed to verify token.');
            }

            $principal = $principalResponse->json();
            $userId = $principal['CurrentUserID'] ?? null;

            if (! $userId) {
                Log::error('Invalid principal response');
                return redirect('/login')->withErrors('Invalid principal response.');
            }

            // 4. Call GetLoggedUserInfo using another Basic Auth key
            $userResponse = Http::withBasicAuth('UMSPRDUSER', 'aU1OJdbhmGwZjoBj') // replace with actual credentials
                ->withOptions(['verify' => false])
                ->get('http://10.153.25.11/UMS.API/api/User/GetLoggedUserInfo', [
                    'UserID' => $userId,
                    'CertificateType' => $principal['CertificateType'],
                ]);

            $userData = $userResponse->json()['Data'] ?? null;

            if (! $userData || empty($userData['CivilID'])) {
                Log::error('User info not found');
                return redirect('/login')->withErrors('User info not found.');
            }

            // 5. Create or update user in DB
            $user = User::firstOrCreate(
                ['civil_id' => $userData['CivilID']],
                [
                    'name' => [
                        'ar' => $userData['ArabicUserFullName'],
                        'en' => $userData['EnglishUserFullName'],
                    ],
                    'email' => $userData['Contact']['Email'] ?? 'info@example.com',
                ]
            );

            if (! $user->hasRole('panel_user')) {
                $user->assignRole('panel_user');
            }

            // 6. Log in the user
            Auth::login($user);
            $request->session()->regenerate();

            if (! $user->profile) {
                event(new UserRegistered($user));
            }

            return redirect('/user')->with('success', 'Logged in successfully!');
        } catch (\Exception $e) {
            Log::error('Login failed', ['error' => $e->getMessage()]);
            return redirect('/login')->withErrors('Login failed: ' . $e->getMessage());
        }
    }
}
