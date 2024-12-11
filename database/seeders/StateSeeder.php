<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [
            // Muscat
            ['name' => json_encode(['en' => 'Bawshar', 'ar' => 'بوشر']), 'province_id' => 1],
            ['name' => json_encode(['en' => 'Seeb', 'ar' => 'السيب']), 'province_id' => 1],
            ['name' => json_encode(['en' => 'Muttrah', 'ar' => 'مطرح']), 'province_id' => 1],
            ['name' => json_encode(['en' => 'Al Amerat', 'ar' => 'العامرات']), 'province_id' => 1],
            ['name' => json_encode(['en' => 'Qurayyat', 'ar' => 'قريات']), 'province_id' => 1],

            // Dhofar
            ['name' => json_encode(['en' => 'Salalah', 'ar' => 'صلالة']), 'province_id' => 2],
            ['name' => json_encode(['en' => 'Taqah', 'ar' => 'طاقة']), 'province_id' => 2],
            ['name' => json_encode(['en' => 'Mirbat', 'ar' => 'مرباط']), 'province_id' => 2],
            ['name' => json_encode(['en' => 'Sadah', 'ar' => 'سدح']), 'province_id' => 2],
            ['name' => json_encode(['en' => 'Shalim and the Hallaniyat Islands', 'ar' => 'شليم وجزر الحلانيات']), 'province_id' => 2],

            // Musandam
            ['name' => json_encode(['en' => 'Khasab', 'ar' => 'خصب']), 'province_id' => 3],
            ['name' => json_encode(['en' => 'Bukha', 'ar' => 'بخاء']), 'province_id' => 3],
            ['name' => json_encode(['en' => 'Dibba', 'ar' => 'دبا']), 'province_id' => 3],
            ['name' => json_encode(['en' => 'Madha', 'ar' => 'مدحاء']), 'province_id' => 3],

            // Al Batinah North
            ['name' => json_encode(['en' => 'Sohar', 'ar' => 'صحار']), 'province_id' => 4],
            ['name' => json_encode(['en' => 'Liwa', 'ar' => 'لوى']), 'province_id' => 4],
            ['name' => json_encode(['en' => 'Shinas', 'ar' => 'شناص']), 'province_id' => 4],
            ['name' => json_encode(['en' => 'Saham', 'ar' => 'صحم']), 'province_id' => 4],
            ['name' => json_encode(['en' => 'Al Khaburah', 'ar' => 'الخابورة']), 'province_id' => 4],
            ['name' => json_encode(['en' => 'Al Suwaiq', 'ar' => 'السويق']), 'province_id' => 4],

            // Al Batinah South
            ['name' => json_encode(['en' => 'Rustaq', 'ar' => 'الرستاق']), 'province_id' => 5],
            ['name' => json_encode(['en' => 'Barka', 'ar' => 'بركاء']), 'province_id' => 5],
            ['name' => json_encode(['en' => 'Nakhal', 'ar' => 'نخل']), 'province_id' => 5],
            ['name' => json_encode(['en' => 'Wadi Al Maawil', 'ar' => 'وادي المعاول']), 'province_id' => 5],
            ['name' => json_encode(['en' => 'Al Awabi', 'ar' => 'العوابي']), 'province_id' => 5],

            // Al Dakhiliyah
            ['name' => json_encode(['en' => 'Nizwa', 'ar' => 'نزوى']), 'province_id' => 6],
            ['name' => json_encode(['en' => 'Bahla', 'ar' => 'بهلاء']), 'province_id' => 6],
            ['name' => json_encode(['en' => 'Adam', 'ar' => 'أدم']), 'province_id' => 6],
            ['name' => json_encode(['en' => 'Manah', 'ar' => 'منح']), 'province_id' => 6],
            ['name' => json_encode(['en' => 'Izki', 'ar' => 'إزكي']), 'province_id' => 6],
            ['name' => json_encode(['en' => 'Samail', 'ar' => 'سمائل']), 'province_id' => 6],
            ['name' => json_encode(['en' => 'Bidbid', 'ar' => 'بدبد']), 'province_id' => 6],

            // Al Wusta
            ['name' => json_encode(['en' => 'Haima', 'ar' => 'هيماء']), 'province_id' => 7],
            ['name' => json_encode(['en' => 'Duqm', 'ar' => 'الدقم']), 'province_id' => 7],
            ['name' => json_encode(['en' => 'Mahut', 'ar' => 'محوت']), 'province_id' => 7],
            ['name' => json_encode(['en' => 'Al Jazir', 'ar' => 'الجازر']), 'province_id' => 7],

            // Ash Sharqiyah North
            ['name' => json_encode(['en' => 'Ibra', 'ar' => 'إبراء']), 'province_id' => 8],
            ['name' => json_encode(['en' => 'Al Qabil', 'ar' => 'القابل']), 'province_id' => 8],
            ['name' => json_encode(['en' => 'Bidiyah', 'ar' => 'بدية']), 'province_id' => 8],
            ['name' => json_encode(['en' => 'Wadi Bani Khalid', 'ar' => 'وادي بني خالد']), 'province_id' => 8],
            ['name' => json_encode(['en' => 'Dima Wa Al Tayeen', 'ar' => 'دماء والطائيين']), 'province_id' => 8],

            // Ash Sharqiyah South
            ['name' => json_encode(['en' => 'Sur', 'ar' => 'صور']), 'province_id' => 9],
            ['name' => json_encode(['en' => 'Jaalan Bani Bu Ali', 'ar' => 'جعلان بني بوعلي']), 'province_id' => 9],
            ['name' => json_encode(['en' => 'Jaalan Bani Bu Hassan', 'ar' => 'جعلان بني بوحسن']), 'province_id' => 9],
            ['name' => json_encode(['en' => 'Masirah', 'ar' => 'مصيرة']), 'province_id' => 9],

            // Al Dhahirah
            ['name' => json_encode(['en' => 'Ibri', 'ar' => 'عبري']), 'province_id' => 10],
            ['name' => json_encode(['en' => 'Yanqul', 'ar' => 'ينقل']), 'province_id' => 10],
            ['name' => json_encode(['en' => 'Dank', 'ar' => 'ضنك']), 'province_id' => 10],

            // Al Buraimi
            ['name' => json_encode(['en' => 'Al Buraimi', 'ar' => 'البريمي']), 'province_id' => 11],
            ['name' => json_encode(['en' => 'Mahdha', 'ar' => 'محضة']), 'province_id' => 11],
            ['name' => json_encode(['en' => 'Al Sinainah', 'ar' => 'السنينة']), 'province_id' => 11],
        ];

        DB::table('states')->insert($states);
    }
}
