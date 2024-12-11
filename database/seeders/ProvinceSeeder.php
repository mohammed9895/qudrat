<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = [
            ['name' => json_encode(['en' => 'Muscat', 'ar' => 'مسقط'])],
            ['name' => json_encode(['en' => 'Dhofar', 'ar' => 'ظفار'])],
            ['name' => json_encode(['en' => 'Musandam', 'ar' => 'مسندم'])],
            ['name' => json_encode(['en' => 'Al Batinah North', 'ar' => 'الباطنة شمال'])],
            ['name' => json_encode(['en' => 'Al Batinah South', 'ar' => 'الباطنة جنوب'])],
            ['name' => json_encode(['en' => 'Al Dakhiliyah', 'ar' => 'الداخلية'])],
            ['name' => json_encode(['en' => 'Al Wusta', 'ar' => 'الوسطى'])],
            ['name' => json_encode(['en' => 'Ash Sharqiyah North', 'ar' => 'الشرقية شمال'])],
            ['name' => json_encode(['en' => 'Ash Sharqiyah South', 'ar' => 'الشرقية جنوب'])],
            ['name' => json_encode(['en' => 'Al Dhahirah', 'ar' => 'الظاهرة'])],
            ['name' => json_encode(['en' => 'Al Buraimi', 'ar' => 'البريمي'])],
        ];

        DB::table('provinces')->insert($provinces);
    }
}
