<?php 


// app/Services/QudratService.php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;

class QudratService
{
    /**
     * Fetch user registration data by national ID and return as Collection.
     *
     * @param string $nationalId
     * @return Collection|null
     */
    public function getRegistrationByNationalId(string $nationalId): ?Collection
    {
        try {
            $response = Http::get('https://qudrat-uat-pki.mol.gov.om/registration', [
                'nationalId' => $nationalId,
            ]);

            if (!$response->ok()) {
                return null;
            }

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
            // You can log the error if needed
            \Log::error('QudratService Error: ' . $e->getMessage());
            return null;
        }
    }
}
