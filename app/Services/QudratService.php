<?php

// app/Services/QudratService.php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class QudratService
{
    /**
     * Fetch user registration data by national ID and return as Collection.
     */
    public function getRegistrationByNationalId(string $nationalId): ?Collection
    {
        try {
            $response = Http::get('https://qudrat-uat-pki.mol.gov.om/registration', [
                'nationalId' => $nationalId,
            ]);

            dd($response);

            if (! $response->ok()) {
                return null;
            }

            dd($response->body());

            $xmlString = $response->body();
            $xmlObject = simplexml_load_string($xmlString);

            if ($xmlObject === false) {
                return null;
            }

            // Convert the XML object to an array
            $array = json_decode(json_encode($xmlObject), true);

            // Return as a Laravel Collection
            return collect($array);

        } catch (\Exception $e) {

            dd($e->getMessage());

            // You can log the error if needed
            \Log::error('QudratService Error: '.$e->getMessage());

            return null;
        }
    }
}
