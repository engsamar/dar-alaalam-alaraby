<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //php artisan db:seed --class=SettingsTableDataSeeder

        Setting::create([
            'email' => 'info@daralaalamalaraby.com',
            'phone' => '01003265652',
            'whatsApp' => '00201003265652',
            'facebook' => 'https://facebook.com',
            'twitter' => 'https://twitter.com',
            'youTube' => 'https://www.youtube.com',
            'instagram' => 'https://instagram.com',
            'about' => [
                'en' => 'daralaalamalaraby',
                'ar' => 'دار العالم العربي'
            ],

            'title' => [
                'en' => 'daralaalamalaraby',
                'ar' => 'دار العالم العربي'
            ],

            'footer' => [
                'en' => '© 2025 daralaalamalaraby. Crafted with by daralaalamalaraby',
                'ar' => '© 2025 daralaalamalaraby. Crafted with by daralaalamalaraby'
            ]

        ]);
    }
}
