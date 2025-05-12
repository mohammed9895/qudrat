<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profile = [
            'user_id' => 1,
            'category_id' => Category::factory()->create()->id,
            'fullname' => 'Mohammed Hamad',
            'username' => 'mohammedhamad',
            'email' => 'toshiba9895@gmial.com',
            'phone' => '94449151',
            'avatar' => 'https://via.placeholder.com/150',
            'position' => 'Full Stack Developer',
            'bio' => 'I am a full stack developer with 10 years of experience',
            'gender' => 0,
            'dob' => '1995-09-08',
            'video' => '',
            'cv' => '',
            'experience_level_id' => 1,
            'country_id' => 1,
            'nationality_id' => 1,
            'province_id' => 1,
            'state_id' => 1,
            'permanent_residence_state_id' => 1,
            'health_status' => 1,
            'disability_id' => 1,
            'education_type_id' => 1,
            'address' => 'PO Box 1011 Alaziba',
            'company' => 'Youth Center',
            'website' => 'https://youthcenter.om',
            'social_facebook' => 'https://facebook.com/mohammedhamad',
            'social_x' => 'https://twitter.com/mohammedhamad',
            'social_linkedin' => 'https://linkedin.com/mohammedhamad',
            'social_github' => 'https://github.com/mohammedhamad',
            'public_profile' => 1,
            'can_send_message' => 1,
            'show_email' => 1,
            'show_phone' => 1,
            'show_location' => 1,
            'show_rating' => 1,
            'status' => 1,
        ];

        DB::table('profiles')->insert($profile);
    }
}
