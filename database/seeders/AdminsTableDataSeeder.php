<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminsTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //php artisan db:seed --class=AdminsTableDataSeeder

        $user = Admin::updateOrCreate(
            [
                'email' => 'admin@admin.com',
            ],
            [
                'name' => 'Samar Hamza',
                'mobile' => '+01003265652',
                'password' => 'admin@123',
                'gender' => 'female'
            ]
        );
        $user->assignRole('super-admin');


        $user = Admin::updateOrCreate(
            [
                'email' => 'admin@daralaalamalaraby.com',
            ],
            [
                'name' => 'Noha Madkour',
                'mobile' => '+201020746516',
                'password' => 'Dar@2025#',
                'gender' => 'female'
            ]
        );
        $user->assignRole('super-admin');
    }
}
