<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Permission\Role;
use Illuminate\Database\Seeder;

class RolesTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //php artisan db:seed --class=RolesTableDataSeeder
        Role::updateOrCreate(['name' => 'admin','guard_name'=>'admin','title'=>['en' => 'Super Admin','ar'=>'الأدمن العام']]);

    }
}