<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Product\Product;
use Illuminate\Database\Seeder;
use App\Models\Product\Category;
use App\Models\Store\Store;

class DemoTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //php artisan db:seed --class=DemoTableDataSeeder
        $store = Store::updateOrCreate(
            [
                'email' => 'default@gmail.com',
                'phone' => '+201003265652',
                'title' => ['en' => 'Default Store', 'ar' => 'Default Store'],
                'active' => 1,
                'slug' => 'default-store'
            ]
        );

        Category::updateOrCreate([
            'title' => [
                'en' => 'Literature',
                'ar' => 'الأدب'
            ],
            'active' => 1,
            'type' => 0,
            'slug' => 'literature'
        ]);

        Category::updateOrCreate([
            'title' => [
                'en' => 'Science',
                'ar' => 'العلوم'
            ],
            'active' => 1,
            'type' => 0,
            'slug' => 'science'
        ]);

        Category::updateOrCreate([
            'title' => [
                'en' => 'History',
                'ar' => 'التاريخ'
            ],
            'active' => 1,
            'type' => 0,
            'slug' => 'history'
        ]);

        Category::updateOrCreate([
            'title' => [
                'en' => 'Religion',
                'ar' => 'الدين'
            ],
            'active' => 1,
            'type' => 0,
            'slug' => 'religion'
        ]);

        Category::updateOrCreate([
            'title' => [
                'en' => 'Philosophy',
                'ar' => 'الفلسفة'
            ],
            'active' => 1,
            'type' => 0,
            'slug' => 'philosophy'
        ]);

        Category::updateOrCreate([
            'title' => [
                'en' => 'Psychology',
                'ar' => 'علم النفس'
            ],
            'active' => 1,
            'type' => 0,
            'slug' => 'psychology'
        ]);

        Category::updateOrCreate([
            'title' => [
                'en' => 'Self Development',
                'ar' => 'التنمية الذاتية'
            ],
            'active' => 1,
            'type' => 0,
            'slug' => 'self-development'
        ]);

        Category::updateOrCreate([
            'title' => [
                'en' => 'Business',
                'ar' => 'الأعمال'
            ],
            'active' => 1,
            'type' => 0,
            'slug' => 'business'
        ]);

        Category::updateOrCreate([
            'title' => [
                'en' => 'Art',
                'ar' => 'الفن'
            ],
            'active' => 1,
            'type' => 0,
            'slug' => 'art'
        ]);

        Category::updateOrCreate([
            'title' => [
                'en' => 'Children',
                'ar' => 'الأطفال'
            ],
            'active' => 1,
            'type' => 0,
            'slug' => 'children'
        ]);

        Category::updateOrCreate([
            'title' => [
                'en' => 'Technology',
                'ar' => 'التكنولوجيا'
            ],
            'active' => 1,
            'type' => 0,
            'slug' => 'technology'
        ]);

        Category::updateOrCreate([
            'title' => [
                'en' => 'Medicine',
                'ar' => 'الطب'
            ],
            'active' => 1,
            'type' => 0,
            'slug' => 'medicine'
        ]);

        Category::updateOrCreate([
            'title' => [
                'en' => 'Engineering',
                'ar' => 'الهندسة'
            ],
            'active' => 1,
            'type' => 0,
            'slug' => 'engineering'
        ]);

        Category::updateOrCreate([
            'title' => [
                'en' => 'Cookbooks',
                'ar' => 'كتب الطبخ'
            ],
            'active' => 1,
            'type' => 0,
            'slug' => 'cookbooks'
        ]);

        Category::updateOrCreate([
            'title' => [
                'en' => 'Travel',
                'ar' => 'السفر'
            ],
            'active' => 1,
            'type' => 0,
            'slug' => 'travel'
        ]);

        Category::updateOrCreate([
            'title' => [
                'en' => 'Poetry',
                'ar' => 'الشعر'
            ],
            'active' => 1,
            'type' => 0,
            'slug' => 'poetry'
        ]);

        Category::updateOrCreate([
            'title' => [
                'en' => 'Comics',
                'ar' => 'القصص المصورة'
            ],
            'active' => 1,
            'type' => 0,
            'slug' => 'comics'
        ]);

        Category::updateOrCreate([
            'title' => [
                'en' => 'Biography',
                'ar' => 'السيرة الذاتية'
            ],
            'active' => 1,
            'type' => 0,
            'slug' => 'biography'
        ]);

        Category::updateOrCreate([
            'title' => [
                'en' => 'Fantasy',
                'ar' => 'الفانتازيا'
            ],
            'active' => 1,
            'type' => 0,
            'slug' => 'fantasy'
        ]);

        Category::updateOrCreate([
            'title' => [
                'en' => 'Mystery',
                'ar' => 'الغموض'
            ],
            'active' => 1,
            'type' => 0,
            'slug' => 'mystery'
        ]);

        Category::updateOrCreate([
            'title' => [
                'en' => 'Thriller',
                'ar' => 'الإثارة'
            ],
            'active' => 1,
            'type' => 0,
            'slug' => 'thriller'
        ]);

        Category::updateOrCreate([
            'title' => [
                'en' => 'Romance',
                'ar' => 'الرومانسية'
            ],
            'active' => 1,
            'type' => 0,
            'slug' => 'romance'
        ]);



        $faker_ar = Factory::create('ar_SA');
        $faker = Factory::create('en_US');
        for ($i = 1; $i <= 5; $i++) {
            Product::create([
                'category_id' => $faker->numberBetween(1, 3), // Random category ID
                'sku' => 'BK-' . $faker->unique()->numberBetween(100, 999), // Unique book SKU
                'title' => [
                    'en' => 'The Great Adventure ' . $i,
                    'ar' => 'المغامرة الكبرى ' . $i
                ],
                'description' => [
                    'en' => 'A thrilling tale of discovery and courage in a land full of mystery.',
                    'ar' => 'قصة مثيرة عن الاكتشاف والشجاعة في أرض مليئة بالغموض.'
                ],
                'slug' => 'book-' . $i,
                'image' => 'images/books/book-' . $i . '.jpg',
                'active' => 1,
                'store_id' => $store->id,
                'price' => $faker->numberBetween(10, 100), // Random price for the book
            ]);

            Product::create([
                'category_id' => $faker->numberBetween(1, 3),
                'sku' => 'BK-' . $faker->unique()->numberBetween(100, 999),
                'title' => [
                    'en' => 'Science of the Future ' . $i,
                    'ar' => 'علم المستقبل ' . $i
                ],
                'description' => [
                    'en' => 'A deep dive into the technologies that will shape the next generation.',
                    'ar' => 'استكشاف عميق للتقنيات التي ستشكل الجيل القادم.'
                ],
                'slug' => 'book-' . $i . '-science',
                'image' => 'images/books/book-science-' . $i . '.jpg',
                'active' => 1,
                'store_id' => $store->id,
                'price' => $faker->numberBetween(10, 100),
            ]);

            Product::create([
                'category_id' => $faker->numberBetween(1, 3),
                'sku' => 'BK-' . $faker->unique()->numberBetween(100, 999),
                'title' => [
                    'en' => 'Journey Through Time ' . $i,
                    'ar' => 'رحلة عبر الزمن ' . $i
                ],
                'description' => [
                    'en' => 'A time-traveling adventure that spans centuries of human history.',
                    'ar' => 'مغامرة عبر الزمن تمتد لقرون من تاريخ البشرية.'
                ],
                'slug' => 'book-' . $i . '-time-travel',
                'image' => 'images/books/book-time-travel-' . $i . '.jpg',
                'active' => 1,
                'store_id' => $store->id,
                'price' => $faker->numberBetween(10, 100),
            ]);

            Product::create([
                'category_id' => $faker->numberBetween(1, 3),
                'sku' => 'BK-' . $faker->unique()->numberBetween(100, 999),
                'title' => [
                    'en' => 'The Heart of the Ocean ' . $i,
                    'ar' => 'قلب المحيط ' . $i
                ],
                'description' => [
                    'en' => 'A captivating novel set in the vast, mysterious oceans of the world.',
                    'ar' => 'رواية ساحرة تدور أحداثها في المحيطات الشاسعة والمجهولة للعالم.'
                ],
                'slug' => 'book-' . $i . '-ocean-heart',
                'image' => 'images/books/book-ocean-heart-' . $i . '.jpg',
                'active' => 1,
                'store_id' => $store->id,
                'price' => $faker->numberBetween(10, 100),
            ]);

            Product::create([
                'category_id' => $faker->numberBetween(1, 3),
                'sku' => 'BK-' . $faker->unique()->numberBetween(100, 999),
                'title' => [
                    'en' => 'The Art of War ' . $i,
                    'ar' => 'فن الحرب ' . $i
                ],
                'description' => [
                    'en' => 'A classic treatise on strategy, tactics, and leadership.',
                    'ar' => 'معالجة كلاسيكية عن الاستراتيجية والتكتيك والقيادة.'
                ],
                'slug' => 'book-' . $i . '-art-of-war',
                'image' => 'images/books/book-art-of-war-' . $i . '.jpg',
                'active' => 1,
                'store_id' => $store->id,
                'price' => $faker->numberBetween(10, 100),
            ]);
        }
    }
}
