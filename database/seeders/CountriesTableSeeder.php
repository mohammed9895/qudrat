<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            ['id' => 1, 'name' => 'Oman', 'code' => 'OM', 'created_at' => '2022-11-07 14:54:25', 'updated_at' => '2022-11-07 14:54:25'],
            ['id' => 2, 'name' => 'Åland Islands', 'code' => 'AX', 'created_at' => '2022-11-07 14:54:25', 'updated_at' => '2022-11-07 14:54:25'],
            ['id' => 3, 'name' => 'Albania', 'code' => 'AL', 'created_at' => '2022-11-07 14:54:25', 'updated_at' => '2022-11-07 14:54:25'],
            ['id' => 4, 'name' => 'Algeria', 'code' => 'DZ', 'created_at' => '2022-11-07 14:54:25', 'updated_at' => '2022-11-07 14:54:25'],
        ];

        DB::table('countries')->insert($countries);
    }
}
