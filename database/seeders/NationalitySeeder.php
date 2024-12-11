<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NationalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nationalities = [
            ['en' => 'Omnai', 'ar' => 'عماني'],
            ['en' => 'Saudi', 'ar' => 'سعودي'],
            ['en' => 'Egyptian', 'ar' => 'مصري'],
            ['en' => 'Jordanian', 'ar' => 'أردني'],
            ['en' => 'Palestinian', 'ar' => 'فلسطيني'],
            ['en' => 'Syrian', 'ar' => 'سوري'],
            ['en' => 'Lebanese', 'ar' => 'لبناني'],
            ['en' => 'Iraqi', 'ar' => 'عراقي'],
            ['en' => 'Yemeni', 'ar' => 'يمني'],
            ['en' => 'Kuwaiti', 'ar' => 'كويتي'],
            ['en' => 'Emirati', 'ar' => 'إماراتي'],
            ['en' => 'Qatari', 'ar' => 'قطري'],
            ['en' => 'Bahraini', 'ar' => 'بحريني'],
            ['en' => 'Omani', 'ar' => 'عماني'],
            ['en' => 'Algerian', 'ar' => 'جزائري'],
            ['en' => 'Tunisian', 'ar' => 'تونسي'],
            ['en' => 'Moroccan', 'ar' => 'مغربي'],
            ['en' => 'Libyan', 'ar' => 'ليبي'],
            ['en' => 'Mauritanian', 'ar' => 'موريتاني'],
            ['en' => 'Somali', 'ar' => 'صومالي'],
            ['en' => 'Djiboutian', 'ar' => 'جيبوتي'],
            ['en' => 'Comorian', 'ar' => 'قمري'],
            ['en' => 'Sudanese', 'ar' => 'سوداني'],
            ['en' => 'Chadian', 'ar' => 'تشادي'],
        ];

        foreach ($nationalities as $nationality) {
            DB::table('nationalities')->insert([
                'name' => json_encode(['en' => $nationality['en'], 'ar' => $nationality['ar']]),
            ]);
        }
    }
}
