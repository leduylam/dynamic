<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use Carbon\Carbon as Carbon;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        //Add the master administrator, user id of 1
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'sku' => '123',
                'phone' => '123',
                'address' => '123',
                'status' => true,
                'password' => bcrypt('12345678'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'User',
                'email' => 'user@user.com',
                'sku' => '123',
                'phone' => '123',
                'address' => '123',
                'status' => true,
                'password' => bcrypt('12345678'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        Admin::insert($users);

        
    }
}
