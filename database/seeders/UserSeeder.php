<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => '2562a09a-9d33-4c2a-9b90-6508bc18e154',
                'name' => 'User',
                'role' => 'User',
                'email' => 'user@codepository.org',
                'email_verified_at' => now(),
                'password' => Hash::make('useruser'),
            ],
            [
                'id' => 'd7c8a5f0-4e1d-46b1-9068-f52e27941764',
                'name' => 'Admin',
                'role' => 'Administrator',
                'email' => 'admin@codepository.org',
                'email_verified_at' => now(),
                'password' => Hash::make('adminadmin'),
            ],
        ];

        DB::table('users')->insert($data);
    }
}
