<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Article\Article;
use Illuminate\Database\Seeder;
use App\Models\Article\Catalogue;

class ArticleTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //php artisan db:seed --class=ArticleTableDataSeeder


        Catalogue::updateOrCreate([
            'title' => [
                'en' => 'Literature',
                'ar' => 'الأدب'
            ],
            'active' => 1,

            'image' => 'images/catalogues/1.png',
            'slug' => 'literature'
        ]);

        Catalogue::updateOrCreate([
            'title' => [
                'en' => 'Science',
                'ar' => 'العلوم'
            ],
            'active' => 1,

            'image' => 'images/catalogues/2.png',
            'slug' => 'science'
        ]);

        Catalogue::updateOrCreate([
            'title' => [
                'en' => 'History',
                'ar' => 'التاريخ'
            ],
            'active' => 1,

            'image' => 'images/catalogues/3.png',
            'slug' => 'history'
        ]);

        Catalogue::updateOrCreate([
            'title' => [
                'en' => 'Religion',
                'ar' => 'الدين'
            ],
            'active' => 1,

            'image' => 'images/catalogues/4.png',
            'slug' => 'religion'
        ]);

        Catalogue::updateOrCreate([
            'title' => [
                'en' => 'Philosophy',
                'ar' => 'الفلسفة'
            ],
            'active' => 1,

            'image' => 'images/catalogues/5.png',
            'slug' => 'philosophy'
        ]);

        Catalogue::updateOrCreate([
            'title' => [
                'en' => 'Psychology',
                'ar' => 'علم النفس'
            ],
            'active' => 1,

            'image' => 'images/catalogues/6.png',
            'slug' => 'psychology'
        ]);

        Catalogue::updateOrCreate([
            'title' => [
                'en' => 'Self Development',
                'ar' => 'التنمية الذاتية'
            ],
            'active' => 1,

            'image' => 'images/catalogues/7.png',
            'slug' => 'self-development'
        ]);

        Catalogue::updateOrCreate([
            'title' => [
                'en' => 'Business',
                'ar' => 'الأعمال'
            ],
            'active' => 1,

            'image' => 'images/catalogues/8.png',
            'slug' => 'business'
        ]);

        Catalogue::updateOrCreate([
            'title' => [
                'en' => 'Art',
                'ar' => 'الفن'
            ],
            'active' => 1,

            'image' => 'images/catalogues/9.png',
            'slug' => 'art'
        ]);

        Catalogue::updateOrCreate([
            'title' => [
                'en' => 'Children',
                'ar' => 'الأطفال'
            ],
            'active' => 1,

            'image' => 'images/catalogues/1.png',
            'slug' => 'children'
        ]);

        Catalogue::updateOrCreate([
            'title' => [
                'en' => 'Technology',
                'ar' => 'التكنولوجيا'
            ],
            'active' => 1,

            'image' => 'images/catalogues/2.png',
            'slug' => 'technology'
        ]);

        Catalogue::updateOrCreate([
            'title' => [
                'en' => 'Medicine',
                'ar' => 'الطب'
            ],
            'active' => 1,

            'image' => 'images/catalogues/3.png',
            'slug' => 'medicine'
        ]);

        Catalogue::updateOrCreate([
            'title' => [
                'en' => 'Engineering',
                'ar' => 'الهندسة'
            ],
            'active' => 1,

            'image' => 'images/catalogues/4.png',
            'slug' => 'engineering'
        ]);

        Catalogue::updateOrCreate([
            'title' => [
                'en' => 'Cookarticles',
                'ar' => 'كتب الطبخ'
            ],
            'active' => 1,

            'image' => 'images/catalogues/5.png',
            'slug' => 'cookarticles'
        ]);

        Catalogue::updateOrCreate([
            'title' => [
                'en' => 'Travel',
                'ar' => 'السفر'
            ],
            'active' => 1,

            'image' => 'images/catalogues/6.png',
            'slug' => 'travel'
        ]);

        Catalogue::updateOrCreate([
            'title' => [
                'en' => 'Poetry',
                'ar' => 'الشعر'
            ],
            'active' => 1,

            'image' => 'images/catalogues/7.png',
            'slug' => 'poetry'
        ]);

        Catalogue::updateOrCreate([
            'title' => [
                'en' => 'Comics',
                'ar' => 'القصص المصورة'
            ],
            'active' => 1,

            'image' => 'images/catalogues/8.png',
            'slug' => 'comics'
        ]);

        Catalogue::updateOrCreate([
            'title' => [
                'en' => 'Biography',
                'ar' => 'السيرة الذاتية'
            ],
            'active' => 1,

            'image' => 'images/catalogues/9.png',
            'slug' => 'biography'
        ]);

        Catalogue::updateOrCreate([
            'title' => [
                'en' => 'Fantasy',
                'ar' => 'الفانتازيا'
            ],
            'active' => 1,

            'image' => 'images/catalogues/9.png',
            'slug' => 'fantasy'
        ]);

        Catalogue::updateOrCreate([
            'title' => [
                'en' => 'Mystery',
                'ar' => 'الغموض'
            ],
            'active' => 1,

            'image' => 'images/catalogues/8.png',
            'slug' => 'mystery'
        ]);

        Catalogue::updateOrCreate([
            'title' => [
                'en' => 'Thriller',
                'ar' => 'الإثارة'
            ],
            'active' => 1,

            'image' => 'images/catalogues/7.png',
            'slug' => 'thriller'
        ]);

        Catalogue::updateOrCreate([
            'title' => [
                'en' => 'Romance',
                'ar' => 'الرومانسية'
            ],
            'active' => 1,

            'image' => 'images/catalogues/6.png',
            'slug' => 'romance'
        ]);



        $faker_ar = Factory::create('ar_SA');
        $faker = Factory::create('en_US');
        for ($i = 1; $i <= 5; $i++) {
            Article::create([
                'catalogue_id' => $faker->numberBetween(1, 3), // Random catalogue ID
                //'sku' => 'BK-' . $faker->unique()->numberBetween(100, 999), // Unique blog SKU
                'title' => [
                    'en' => 'The Great Adventure ' . $i,
                    'ar' => 'المغامرة الكبرى ' . $i
                ],
                'description' => [
                    'en' => 'A thrilling tale of discovery and courage in a land full of mystery.',
                    'ar' => 'قصة مثيرة عن الاكتشاف والشجاعة في أرض مليئة بالغموض.'
                ],
                'slug' => 'blog-' . $i,
                'image' => 'images/articles/blog_' . $i . '.jpg',
                'active' => 1,

            ]);

            Article::create([
                'catalogue_id' => $faker->numberBetween(1, 3),
                //'sku' => 'BK-' . $faker->unique()->numberBetween(100, 999),
                'title' => [
                    'en' => 'Science of the Future ' . $i,
                    'ar' => 'علم المستقبل ' . $i
                ],
                'description' => [
                    'en' => 'A deep dive into the technologies that will shape the next generation.',
                    'ar' => 'استكشاف عميق للتقنيات التي ستشكل الجيل القادم.'
                ],
                'slug' => 'blog-' . $i . '-science',
                'image' => 'images/articles/blog_' . $i . '.jpg',
                'active' => 1,

            ]);

            Article::create([
                'catalogue_id' => $faker->numberBetween(1, 3),
                //'sku' => 'BK-' . $faker->unique()->numberBetween(100, 999),
                'title' => [
                    'en' => 'Journey Through Time ' . $i,
                    'ar' => 'رحلة عبر الزمن ' . $i
                ],
                'description' => [
                    'en' => 'A time-traveling adventure that spans centuries of human history.',
                    'ar' => 'مغامرة عبر الزمن تمتد لقرون من تاريخ البشرية.'
                ],
                'slug' => 'blog-' . $i . '-time-travel',
                'image' => 'images/articles/blog_' . $i . '.jpg',
                'active' => 1,

            ]);

            Article::create([
                'catalogue_id' => $faker->numberBetween(1, 3),
                //'sku' => 'BK-' . $faker->unique()->numberBetween(100, 999),
                'title' => [
                    'en' => 'The Heart of the Ocean ' . $i,
                    'ar' => 'قلب المحيط ' . $i
                ],
                'description' => [
                    'en' => 'A captivating novel set in the vast, mysterious oceans of the world.',
                    'ar' => 'رواية ساحرة تدور أحداثها في المحيطات الشاسعة والمجهولة للعالم.'
                ],
                'slug' => 'blog-' . $i . '-ocean-heart',
                'image' => 'images/articles/blog_' . $i . '.jpg',
                'active' => 1,

            ]);

            Article::create([
                'catalogue_id' => $faker->numberBetween(1, 3),
                //'sku' => 'BK-' . $faker->unique()->numberBetween(100, 999),
                'title' => [
                    'en' => 'The Art of War ' . $i,
                    'ar' => 'فن الحرب ' . $i
                ],
                'description' => [
                    'en' => 'A classic treatise on strategy, tactics, and leadership.',
                    'ar' => 'معالجة كلاسيكية عن الاستراتيجية والتكتيك والقيادة.'
                ],
                'slug' => 'blog-' . $i . '-art-of-war',
                'image' => 'images/articles/blog_' . $i . '.jpg',
                'active' => 1,

            ]);
        }
    }
}
