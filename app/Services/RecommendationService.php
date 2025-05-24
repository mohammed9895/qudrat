<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RecommendationService
{
    public static function getSkillRecommendations(array $userProfile): array
    {
        $response = Http::post('https://alsaidi33.pythonanywhere.com/ai/recommendations/section', [
            'section' => 'skills',
            'language' => 'ar',
            'userProfile' => $userProfile,
        ]);

        return $response->successful()
            ? $response->json()
            : ['error' => 'API request failed'];
    }

    public static function getSectionRecommendation(array $userProfile, string $section, string $language = 'ar'): array
    {
        $response = Http::post('https://alsaidi33.pythonanywhere.com/ai/recommendations/section', [
            'section' => $section,
            'language' => $language,
            'userProfile' => $userProfile,
        ]);

        return $response->successful()
            ? $response->json()
            : ['error' => 'API request failed'];
    }
}
