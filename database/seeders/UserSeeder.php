<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Storage;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users =  [
            [
                'name' => 'administrator',
                'email' => 'admin@admin.com',
                'password' => bcrypt('password'),
                'role' => '1', //admin
                'avatar' => 'admin.png',
            ],
            [
                'name' => 'user',
                'email' => 'user@admin.com',
                'password' => bcrypt('password'),
                'role' => '0', //user
                'avatar' => 'user.png',
            ]
        ];

        DB::table('users')->insert($users);
    }
}
