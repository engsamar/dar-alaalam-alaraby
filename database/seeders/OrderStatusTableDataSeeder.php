<?php

namespace Database\Seeders;

use App\Models\Ordering\Status;
use Illuminate\Database\Seeder;

class OrderStatusTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //php artisan db:seed --class=OrderStatusTableDataSeeder

        Status::updateOrCreate(['slug' => 'pending'],['title'=>['en' => 'PENDING','ar'=>'قيد الإنتظار'],'active' => 1,'slug' => 'pending']);
        Status::updateOrCreate(['slug' => 'accepted'],['title'=>['en' => 'ACCEPTED','ar'=>'قبول'],'active' => 1,'slug' => 'accepted']);
        Status::updateOrCreate(['slug' => 'rejected'],['title'=>['en' => 'REJECTED','ar'=>'رفض الطلب '],'active' => 1,'slug' => 'rejected']);
        Status::updateOrCreate(['slug' => 'delivered'],['title'=>['en' => 'DELIVERED','ar'=>'توصيل الطلب'],'active' => 1,'slug' => 'delivered']);
        Status::updateOrCreate(['slug' => 'canceled'],['title'=>['en' => 'CANCELED','ar'=>'إلغاء الطلب'],'active' => 1,'slug' => 'canceled']);

    }
}
