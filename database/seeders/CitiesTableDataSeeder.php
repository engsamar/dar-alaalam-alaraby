<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitiesTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // php artisan db:seed --class=CitiesTableDataSeeder
        // truncate cities table
        // stop check foreign
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        City::truncate();

        // insert all egypt cities
        $cities = [
            [
                'name_en' => 'Cairo',
                'name_ar' => 'القاهرة',
            ],
            [
                'name_en' => 'Alexandria',
                'name_ar' => 'الإسكندرية',
            ],
            [
                'name_en' => 'Giza',
                'name_ar' => 'الجيزة',
            ],
            [
                'name_en' => 'Shubra El Kheima',
                'name_ar' => 'شبرا الخيمة',
            ],
            [
                'name_en' => 'Port Said',
                'name_ar' => 'بورسعيد',
            ],
            [
                'name_en' => 'Suez',
                'name_ar' => 'السويس',
            ],
            [
                'name_en' => 'Luxor',
                'name_ar' => 'الأقصر',
            ],
            [
                'name_en' => 'Aswan',
                'name_ar' => 'أسوان',
            ],
            [
                'name_en' => 'Mansoura',
                'name_ar' => 'المنصورة',
            ],
            [
                'name_en' => 'Tanta',
                'name_ar' => 'طنطا',
            ],
            [
                'name_en' => 'Faiyum',
                'name_ar' => 'الفيوم',
            ],
            [
                'name_en' => 'Zagazig',
                'name_ar' => 'الزقازيق',
            ],
            [
                'name_en' => 'Ismailia',
                'name_ar' => 'الإسماعيلية',
            ],
            [
                'name_en' => 'Minya',
                'name_ar' => 'المنيا',
            ],
            [
                'name_en' => 'Assiut',
                'name_ar' => 'أسيوط',
            ],
            [
                'name_en' => 'Damanhur',
                'name_ar' => 'دمنهور',
            ],
            [
                'name_en' => 'Beni Suef',
                'name_ar' => 'بني سويف',
            ],
            [
                'name_en' => 'Kafr El Sheikh',
                'name_ar' => 'كفر الشيخ',
            ],
            [
                'name_en' => 'Qena',
                'name_ar' => 'قنا',
            ],
            [
                'name_en' => 'Damietta',
                'name_ar' => 'دمياط',
            ],
        ];

        foreach ($cities as $city) {
            City::create(
                [
                    'active' => 1,
                    'title' => ['en' => $city['name_en'], 'ar' => $city['name_ar']],
                ]
            );
        }
    }
}
