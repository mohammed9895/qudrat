<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Language;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

$languages = [
    ['name' => ['en' => 'Arabic', 'ar' => 'العربية']],
    ['name' => ['en' => 'English', 'ar' => 'الإنجليزية']],
    ['name' => ['en' => 'French', 'ar' => 'الفرنسية']],
    ['name' => ['en' => 'Spanish', 'ar' => 'الإسبانية']],
    ['name' => ['en' => 'German', 'ar' => 'الألمانية']],
    ['name' => ['en' => 'Italian', 'ar' => 'الإيطالية']],
    ['name' => ['en' => 'Russian', 'ar' => 'الروسية']],
    ['name' => ['en' => 'Chinese', 'ar' => 'الصينية']],
    ['name' => ['en' => 'Japanese', 'ar' => 'اليابانية']],
    ['name' => ['en' => 'Hindi', 'ar' => 'الهندية']],
    ['name' => ['en' => 'Portuguese', 'ar' => 'البرتغالية']],
    ['name' => ['en' => 'Dutch', 'ar' => 'الهولندية']],
    ['name' => ['en' => 'Swedish', 'ar' => 'السويدية']],
    ['name' => ['en' => 'Norwegian', 'ar' => 'النرويجية']],
    ['name' => ['en' => 'Danish', 'ar' => 'الدنماركية']],
    ['name' => ['en' => 'Finnish', 'ar' => 'الفنلندية']],
    ['name' => ['en' => 'Greek', 'ar' => 'اليونانية']],
    ['name' => ['en' => 'Turkish', 'ar' => 'التركية']],
    ['name' => ['en' => 'Polish', 'ar' => 'البولندية']],
    ['name' => ['en' => 'Czech', 'ar' => 'التشيكية']],
    ['name' => ['en' => 'Hungarian', 'ar' => 'المجرية']],
    ['name' => ['en' => 'Thai', 'ar' => 'التايلاندية']],
    ['name' => ['en' => 'Korean', 'ar' => 'الكورية']],
    ['name' => ['en' => 'Vietnamese', 'ar' => 'الفيتنامية']],
    ['name' => ['en' => 'Hebrew', 'ar' => 'العبرية']],
    ['name' => ['en' => 'Persian', 'ar' => 'الفارسية']],
    ['name' => ['en' => 'Bengali', 'ar' => 'البنغالية']],
    ['name' => ['en' => 'Punjabi', 'ar' => 'البنجابية']],
    ['name' => ['en' => 'Urdu', 'ar' => 'الأردية']],
    ['name' => ['en' => 'Malay', 'ar' => 'الماليزية']],
    ['name' => ['en' => 'Tagalog', 'ar' => 'التاجالوج']],
    ['name' => ['en' => 'Swahili', 'ar' => 'السواحيلية']],
    ['name' => ['en' => 'Zulu', 'ar' => 'الزولو']],
    ['name' => ['en' => 'Xhosa', 'ar' => 'الخوسا']],
    ['name' => ['en' => 'Tamil', 'ar' => 'التاميلية']],
    ['name' => ['en' => 'Telugu', 'ar' => 'التيلوجو']],
    ['name' => ['en' => 'Marathi', 'ar' => 'الماراثية']],
    ['name' => ['en' => 'Gujarati', 'ar' => 'الغوجاراتية']],
    ['name' => ['en' => 'Malayalam', 'ar' => 'المالايالامية']],
    ['name' => ['en' => 'Sinhalese', 'ar' => 'السينهالية']],
    ['name' => ['en' => 'Nepali', 'ar' => 'النيبالية']],
    ['name' => ['en' => 'Kazakh', 'ar' => 'الكازاخستانية']],
    ['name' => ['en' => 'Uzbek', 'ar' => 'الأوزبكية']],
    ['name' => ['en' => 'Armenian', 'ar' => 'الأرمنية']],
    ['name' => ['en' => 'Georgian', 'ar' => 'الجورجية']],
    ['name' => ['en' => 'Mongolian', 'ar' => 'المنغولية']],
    ['name' => ['en' => 'Azerbaijani', 'ar' => 'الأذربيجانية']],
    ['name' => ['en' => 'Albanian', 'ar' => 'الألبانية']],
    ['name' => ['en' => 'Bosnian', 'ar' => 'البوسنية']],
    ['name' => ['en' => 'Serbian', 'ar' => 'الصربية']],
    ['name' => ['en' => 'Croatian', 'ar' => 'الكرواتية']],
    ['name' => ['en' => 'Slovak', 'ar' => 'السلوفاكية']],
    ['name' => ['en' => 'Romanian', 'ar' => 'الرومانية']],
    ['name' => ['en' => 'Bulgarian', 'ar' => 'البلغارية']],
    ['name' => ['en' => 'Ukrainian', 'ar' => 'الأوكرانية']],
    ['name' => ['en' => 'Lithuanian', 'ar' => 'الليتوانية']],
    ['name' => ['en' => 'Latvian', 'ar' => 'اللاتفية']],
    ['name' => ['en' => 'Estonian', 'ar' => 'الإستونية']],
    ['name' => ['en' => 'Icelandic', 'ar' => 'الأيسلندية']],
    ['name' => ['en' => 'Welsh', 'ar' => 'الويلزية']],
    ['name' => ['en' => 'Irish', 'ar' => 'الأيرلندية']],
    ['name' => ['en' => 'Scottish Gaelic', 'ar' => 'الغايلية الاسكتلندية']],
    ['name' => ['en' => 'Basque', 'ar' => 'الباسكية']],
    ['name' => ['en' => 'Catalan', 'ar' => 'الكاتالونية']],
    ['name' => ['en' => 'Galician', 'ar' => 'الجاليقية']],
    ['name' => ['en' => 'Esperanto', 'ar' => 'الإسبيرانتو']],
    ['name' => ['en' => 'Haitian Creole', 'ar' => 'الكريولية الهايتية']],
];

foreach ($languages as $language) {
    Language::create($language);
}
    }
}
