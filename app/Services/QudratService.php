<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class QudratService
{
    public function getRegistrationByNationalId(string $nationalId): ?Collection
    {
        try {
            $response = Http::withoutVerifying()->get('https://qudrat-prd-pki.mol.gov.om/registration', [
                'nationalId' => $nationalId,
            ]);

            if (! $response->ok()) {
                return null;
            }

            $xmlString = $response->body();
            $xmlObject = simplexml_load_string($xmlString);

            if ($xmlObject === false) {
                return null;
            }

            // Convert to array
            $array = json_decode(json_encode($xmlObject), true);

            // ✅ Check for issuccess = false or message contains "No Data"
            if (
                isset($array['issuccess']) && $array['issuccess'] === 'false' ||
                str_contains(strtolower($array['message'] ?? ''), 'no data')
            ) {
                \Log::warning("QudratService: No data retrieved for {$nationalId}", [
                    'response' => $array,
                ]);

                return null;
            }

            return collect($array);
        } catch (\Exception $e) {
            \Log::error('QudratService Error: '.$e->getMessage());

            return null;
        }
    }
}
