<?php

namespace Database\Seeders;

use App\Helpers\Constants;
use App\Models\Page;
use Illuminate\Database\Seeder;

class PagesTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //php artisan db:seed --class=PagesTableDataSeeder
        Page::updateOrCreate(
            [
                'active' => 1,
                'slug' => 'about',
                'type' => Constants::ABOUT_PAGE_TYPE,
                'title' => ['en' => 'About dar alaalam alaraby', 'ar' => 'دار العالم العربي'],
                'description' => [
                    'en' => 'Content will be here.Content will be here.Content will be here.Content will be here.Content will be here.Content will be here.',
                    'ar' => 'Content will be here.Content will be here.Content will be here.Content will be here.Content will be here.Content will be here.'
                ]
            ]
        );
        Page::updateOrCreate(
            [
                'active' => 1,
                'slug' => 'vision',
                'type' => Constants::VISION_PAGE_TYPE,
                'title' => ['en' => 'Our Vision', 'ar' => 'رؤيتنا'],
                'description' => [
                    'en' => 'Content will be here.Content will be here.Content will be here.Content will be here.Content will be here.Content will be here.',
                    'ar' => 'Content will be here.Content will be here.Content will be here.Content will be here.Content will be here.Content will be here.'
                ]
            ]
        );
        Page::updateOrCreate(
            [
                'active' => 1,
                'slug' => 'mission',
                'type' => Constants::MISSION_PAGE_TYPE,
                'title' => ['en' => 'Our Mission', 'ar' => ' رسالتنا'],
                'description' => [
                    'en' => 'Content will be here.Content will be here.Content will be here.Content will be here.Content will be here.Content will be here.',
                    'ar' => 'Content will be here.Content will be here.Content will be here.Content will be here.Content will be here.Content will be here.'
                ]
            ]
        );

        Page::updateOrCreate(
            [
                'active' => 1,
                'slug' => 'subscribe',
                'type' => Constants::SUBSCRIBE_PAGE_TYPE,
                'title' => ['en' => 'Subscribe to our newsletter!', 'ar' => ' اشترك في نشرتنا الإخبارية!'],
                'description' => [
                    'en' => 'Sign up for our mailing list to get the latest updates news & offers.',
                    'ar' => 'قم بالتسجيل في قائمتنا البريدية للحصول على آخر الأخبار والعروض.'
                ]
            ]
        );
    }
}
