<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth; // ✅ Correct package
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Auth;
use App\Events\UserRegistered;

class AuthController extends Controller
{
    public function handleQudratLoginCallback(Request $request)
    {
        $token = $request->query('token');

        if (!$token) {
            return redirect('/login')->withErrors('No token received.');
        }

        try {

            // 🔥 Get Qudrat secret from env
            $secret = env('QUDRAT_JWT_SECRET');

            if (!$secret) {
                throw new \Exception('Qudrat JWT secret not set in .env');
            }

            // 🔥 Decode the Qudrat token
            $decoded = JWT::decode($token, new Key('aP3xW9z!Q4eR7tY*uI2oP6lKjH1gFnBcDvSm5', 'HS256'));


            // 🔥 Extract user info
            $civilId = $decoded->CivilId ?? null;
            $fullNameArabic = $decoded->FullNameArabic ?? null;
            $fullNameEnglish = $decoded->FullNameEnglish ?? null;

            if (!$civilId) {
                return redirect('/login')->withErrors('Invalid token payload.');
            }


            $oldUser = User::where('civil_id', $civilId)->count();


            if($oldUser <= 0) {
                 // 🔥 Find or create user
                $user = User::firstOrCreate(
                    ['civil_id' => $civilId], // Assuming your User model has 'civil_id'
                    ['name' => [
                            'en' => $fullNameEnglish,
                            'ar' => $fullNameArabic,
                        ],  
                    ]
                );
                event(new UserRegistered($user));
            }

             // 🔥 Find or create user
             $user = User::firstOrCreate(
                ['civil_id' => $civilId], // Assuming your User model has 'civil_id'
                ['name' => [
                        'en' => $fullNameEnglish,
                        'ar' => $fullNameArabic,
                    ],  
                ]
            );


           

            // 🔥 Log the user into Laravel
            Auth::login($user);

            // 🔥 Redirect to dashboard (or wherever you want)
            return redirect('/user')->with('success', 'Logged in successfully!');

        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect('/login')->withErrors('Token verification failed: ' . $e->getMessage());
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
