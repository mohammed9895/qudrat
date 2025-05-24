<?php

namespace App\Http\Controllers;

use App\Events\UserRegistered;
use App\Models\User;
// ✅ Correct package
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    // public function handleQudratLoginCallback(Request $request)
    // {
    //     $token = $request->query('token');

    //     if (!$token) {
    //         return redirect('/login')->withErrors('No token received.');
    //     }

    //     try {

    //         // 🔥 Get Qudrat secret from env
    //         $secret = env('QUDRAT_JWT_SECRET');

    //         if (!$secret) {
    //             throw new \Exception('Qudrat JWT secret not set in .env');
    //         }

    //         // 🔥 Decode the Qudrat token
    //         $decoded = JWT::decode($token, new Key('aP3xW9z!Q4eR7tY*uI2oP6lKjH1gFnBcDvSm5', 'HS256'));

    //         // 🔥 Extract user info
    //         $civilId = $decoded->CivilId ?? null;
    //         $fullNameArabic = $decoded->FullNameArabic ?? null;
    //         $fullNameEnglish = $decoded->FullNameEnglish ?? null;

    //         if (!$civilId) {
    //             return redirect('/login')->withErrors('Invalid token payload.');
    //         }

    //         $oldUser = User::where('civil_id', $civilId)->count();

    //         if($oldUser <= 0) {
    //              // 🔥 Find or create user
    //             $user = User::firstOrCreate(
    //                 ['civil_id' => $civilId], // Assuming your User model has 'civil_id'
    //                 ['name' => [
    //                         'en' => $fullNameEnglish,
    //                         'ar' => $fullNameArabic,
    //                     ],
    //                 ]
    //             );
    //             event(new UserRegistered($user));
    //         }

    //          // 🔥 Find or create user
    //          $user = User::firstOrCreate(
    //             ['civil_id' => $civilId], // Assuming your User model has 'civil_id'
    //             ['name' => [
    //                     'en' => $fullNameEnglish,
    //                     'ar' => $fullNameArabic,
    //                 ],
    //             ]
    //         );

    //         // 🔥 Log the user into Laravel
    //         Auth::login($user);

    //         // 🔥 Redirect to dashboard (or wherever you want)
    //         return redirect('/user')->with('success', 'Logged in successfully!');

    //     } catch (\Exception $e) {
    //         dd($e->getMessage());
    //         return redirect('/login')->withErrors('Token verification failed: ' . $e->getMessage());
    //     }
    // }

    public function handleQudratLoginCallback(Request $request)
    {
        // 1. Get token from query or cookie
        $token = strtok($request->cookie('AUTH_COOKIE'), '|');

        // dd($request->cookie('AUTH_COOKIE'));

        if (! $token) {
            dd('no token');

            return redirect('/login')->withErrors('No token received.');
        }

        try {
            // 2. Call GetPrincipal with Basic Auth

                $username = 'eJWTUserName';
                $password = 'eP@ssw0rd@123abc';

                // Encode the username and password in base64
                $basicAuth = base64_encode("eJWTUserName:eP@ssw0rd@123abc");

                $principalResponse = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Basic ' . $basicAuth,
                ])->post('https://api.mol.gov.om/sso.token.api/api/Token/GetPrincipal', [
                    'Token' => $token
                ]);

                if ($principalResponse->failed()) {
                    \Log::error('API Request Failed', [
                        'status' => $principalResponse->status(),
                        'body' => $principalResponse->body(),
                    ]);
                }

            if (! $principalResponse->successful()) {
                dd('Failed to verify token.');

                return redirect('/login')->withErrors('Failed to verify token.');
            }

            $principal = $principalResponse->json();
            $userId = $principal['CurrentUserID'] ?? null;

            if (! $userId) {
                dd('Invalid principal response.');

                return redirect('/login')->withErrors('Invalid principal response.');
            }

            // 3. Call GetLoggedUserInfo using another Basic Auth key
            $userResponse = Http::withBasicAuth('UMSDEVUSER', 'xbwdjsMHtpL5MWL3') // ← replace with actual credentials
                ->withOptions(['verify' => false])
                ->get('http://api.mol.gov.om/UMS.API/api/User/GetLoggedUserInfo', [
                    'UserID' => $userId,
                    'CertificateType' => $principal['CertificateType'],
                ]);

            $userData = $userResponse->json()['Data'] ?? null;

            if (! $userData || empty($userData['CivilID'])) {
                dd('User info not found.');

                return redirect('/login')->withErrors('User info not found.');
            }

            // 4. Create or update user in DB
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

            // 5. Log in the user
            Auth::login($user);

            $request->session()->regenerate();

            if (! $user->profile) {
                event(new UserRegistered($user));
            }

            return redirect('/user')->with('success', 'Logged in successfully!');

        } catch (\Exception $e) {
            dd($e->getMessage());

            return redirect('/login')->withErrors('Login failed: '.$e->getMessage());
        }
    }

    public function handleQudratLogoutCallback(Request $request)
    {
        auth()->logout();

        // You can clear the session if needed
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to homepage or show a logout message
        return redirect('/')->with('status', 'You have been logged out successfully.');
    }
}
