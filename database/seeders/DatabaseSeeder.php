<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\DigitalLibraryCategory;
use App\Models\DigitalLibraryPost;
use App\Models\DigitalLibraryPostComment;
use App\Models\DigitalLibraryTag;
use App\Models\FieldOfStudy;
use App\Models\Interest;
use App\Models\Language;
use App\Models\MediaCenterComment;
use App\Models\MediaCenterPost;
use App\Models\Profile;
use App\Models\ProfileRating;
use App\Models\School;
use App\Models\Skill;
use App\Models\Tool;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Work;
use App\Models\WorkCategory;
use App\Models\WorkTag;
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
            'civil_id' => '12345678',
        ]);

        $this->call(CountriesTableSeeder::class);

        $this->call(ProvinceSeeder::class);

        $this->call(StateSeeder::class);

        $this->call(EducationTypeSeeder::class);

        $this->call(EmployeeTypeSeeder::class);

        $this->call(LanguageSeeder::class);

        $this->call(DisabilitySeeder::class);

        $this->call(ExperienceLevelSeeder::class);

        $this->call(NationalitySeeder::class);

        Category::factory(50)->create();

        School::factory(50)->create();

        DigitalLibraryCategory::factory(50)->create();

        DigitalLibraryPost::factory(50)->create();

        DigitalLibraryTag::factory(50)->create();

        DigitalLibraryPostComment::factory(50)->create();

        Interest::factory(50)->create();

        MediaCenterPost::factory(50)->create();

        MediaCenterComment::factory(50)->create();

        Profile::factory(50)->create();

        ProfileRating::factory(50)->create();

        Skill::factory(50)->create();

        Tool::factory(50)->create();

        Work::factory(50)->create();

        WorkCategory::factory(50)->create();

        WorkTag::factory(50)->create();

        FieldOfStudy::factory(50)->create();

        Interest::factory(50)->create();


        $this->call(ProfileSeeder::class);

    }
}
