<?php

namespace Database\Seeders;

use App\Models\DigitalLibraryCategory;
use App\Models\DigitalLibraryPost;
use App\Models\DigitalLibraryPostComment;
use App\Models\DigitalLibraryTag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Mohammed Hamad',
            'email' => 'toshiba9895@gmail.com',
        ]);

        DigitalLibraryCategory::factory(20)->create();

        DigitalLibraryPost::factory(20)->create();

        DigitalLibraryTag::factory(20)->create();

        DigitalLibraryPostComment::factory(20)->create();

//        $this->call(CountriesTableSeeder::class);
    }
}
