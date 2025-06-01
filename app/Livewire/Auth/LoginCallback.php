<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\User;
use App\Events\UserRegistered;
use App\Services\QudratService;

class LoginCallback extends Component
{
    public $loading = true;
    public $error = null;

    public function mount() {}

    public function processLogin()
    {
        sleep(30);
        try {
            $token = strtok(request()->cookie('AUTH_COOKIE'), '|');

            if (!$token) {
                $this->error = 'No token received.';
                return;
            }

            $basicAuth = base64_encode("eJWTUserName:eP@ssw0rd@123abc");

            $principalResponse = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ' . $basicAuth,
            ])->post('http://10.153.25.11/sso.token.api/api/Token/GetPrincipal', [
                'Token' => $token
            ]);

            if (!$principalResponse->successful()) {
                $this->error = 'Failed to verify token.';
                return;
            }

            $principal = $principalResponse->json();
            $userId = $principal['CurrentUserID'] ?? null;

            if (!$userId) {
                $this->error = 'Invalid principal response.';
                return;
            }

            $userResponse = Http::withBasicAuth('UMSPRDUSER', 'aU1OJdbhmGwZjoBj')
                ->withOptions(['verify' => false])
                ->get('http://10.153.25.11/UMS.API/api/User/GetLoggedUserInfo', [
                    'UserID' => $userId,
                    'CertificateType' => $principal['CertificateType'],
                ]);

            $userData = $userResponse->json()['Data'] ?? null;

            if (!$userData || empty($userData['CivilID'])) {
                $this->error = 'User info not found.';
                return;
            }

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

            if (!$user->hasRole('panel_user')) {
                $user->assignRole('panel_user');
            }

            Auth::login($user);
            session()->regenerate();

            // ✅ Call QudratService only once
            $qudratService = new QudratService();
            $registrationData = $qudratService->getRegistrationByNationalId($user->civil_id);

            // ✅ Pass both data sources to event
            event(new UserRegistered(
                user: $user,
                registrationData: $registrationData,
                fallbackData: !$registrationData ? $userData : null
            ));

            // ✅ Finally redirect
            redirect('/user')->with('success', 'Logged in successfully!');
        } catch (\Exception $e) {
            $this->error = 'Login failed: ' . $e->getMessage();
        } finally {
            $this->loading = false;
        }
    }

    public function render()
    {
        return view('livewire.auth.login-callback');
    }
}
