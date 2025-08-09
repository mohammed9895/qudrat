<?php

namespace App\Livewire\Auth;

use App\Events\UserRegistered;
use App\Models\User;
use App\Services\QudratService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

class LoginCallback extends Component
{
    public $loading = true;
    public $error = null;
    public $debugId = null; // <-- show this in UI if something breaks

    public function booted()
    {
        $this->processLogin();
    }

    public function processLogin()
    {
        $this->debugId = (string) Str::uuid(); // one ID per attempt
        Log::withContext([
            'debug_id' => $this->debugId,
            'component' => self::class,
        ]);

        try {
            $cookie = request()->cookie('AUTH_COOKIE');
            $token  = $cookie ? strtok($cookie, '|') : null;

            if (!$token) {
                $this->error = 'No token received. Ref: '.$this->debugId;
                Log::warning('AUTH_COOKIE missing or malformed');
                return;
            }

            $basicAuth = base64_encode('eJWTUserName:eP@ssw0rd@123abc');

            // --- 1) GetPrincipal
            $principalResponse = Http::withHeaders([
                    'Content-Type'  => 'application/json',
                    'Authorization' => 'Basic '.$basicAuth,
                ])
                ->timeout(10)
                ->retry(2, 200)
                ->asJson()
                ->post('http://10.153.25.11/sso.token.api/api/Token/GetPrincipal', [
                    'Token' => $token,
                ]);

            if (!$principalResponse->successful()) {
                Log::error('GetPrincipal failed', [
                    'status' => $principalResponse->status(),
                    'body'   => $this->truncate($principalResponse->body()),
                ]);
                $this->error = 'Failed to verify token. Ref: '.$this->debugId;
                return;
            }

            $principal = $principalResponse->json();
            $userId    = $principal['CurrentUserID'] ?? null;

            if (!$userId) {
                Log::error('Invalid principal response', ['json' => $principal]);
                $this->error = 'Invalid principal response. Ref: '.$this->debugId;
                return;
            }

            // --- 2) GetLoggedUserInfo
            $userResponse = Http::withBasicAuth('UMSPRDUSER', 'aU1OJdbhmGwZjoBj')
                ->withOptions(['verify' => false])
                ->timeout(10)
                ->retry(2, 200)
                ->get('http://10.153.25.11/UMS.API/api/User/GetLoggedUserInfo', [
                    'UserID'          => $userId,
                    'CertificateType' => $principal['CertificateType'] ?? null,
                ]);

            if (!$userResponse->successful()) {
                Log::error('GetLoggedUserInfo failed', [
                    'status' => $userResponse->status(),
                    'body'   => $this->truncate($userResponse->body()),
                ]);
                $this->error = 'User info request failed. Ref: '.$this->debugId;
                return;
            }

            $userData = data_get($userResponse->json(), 'Data');

            if (! $userData || empty($userData['CivilID'])) {
                Log::error('User info missing CivilID', ['json' => $userResponse->json()]);
                $this->error = 'User info not found. Ref: '.$this->debugId;
                return;
            }

            $user = User::firstOrCreate(
                ['civil_id' => $userData['CivilID']],
                [
                    'name' => [
                        'ar' => $userData['ArabicUserFullName'] ?? null,
                        'en' => $userData['EnglishUserFullName'] ?? null,
                    ],
                    'email' => data_get($userData, 'Contact.Email', 'info@example.com'),
                ]
            );

            if (! $user->hasRole('panel_user')) {
                $user->assignRole('panel_user');
            }

            Auth::login($user);
            session()->regenerate();

            $qudratService     = new QudratService;
            $registrationData  = $qudratService->getRegistrationByNationalId($user->civil_id);

            event(new UserRegistered(
                user: $user,
                registrationData: $registrationData,
                fallbackData: ! $registrationData ? $userData : null
            ));

            redirect('/user')->with('success', 'Logged in successfully!');
        } catch (\Throwable $e) {
            // Always log the full exception with the debug ID
            Log::error('Login failed with exception', [
                'exception' => $e,
                'message'   => $e->getMessage(),
            ]);

            $this->error = 'Login failed. Ref: '.$this->debugId;
        } finally {
            $this->loading = false;
        }
    }

    private function truncate(?string $s, int $limit = 2000): ?string
    {
        if ($s === null) return null;
        return mb_strlen($s) > $limit ? (mb_substr($s, 0, $limit).'... [truncated]') : $s;
    }

    #[Layout('components.layouts.loading')]
    public function render()
    {
        return view('livewire.auth.login-callback');
    }
}
