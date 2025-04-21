<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Awaz',
                'email' => 'awaz@kkyo.org',
                'password' => Hash::make('12345678'),
                'role' => 1,
                'department_code' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ahmad',
                'email' => 'ahmad@kkyo.org',
                'password' => Hash::make('12345678'),
                'role' => 2,
                'department_code' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bala',
                'email' => 'bala@kkyo.org',
                'password' => Hash::make('12345678'),
                'role' => 3,
                'department_code' => 300,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ashna',
                'email' => 'ashna@kkyo.org',
                'password' => Hash::make('12345678'),
                'role' => 4,
                'department_code' => 400,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sarezh',
                'email' => 'sarezh@kkyo.org',
                'password' => Hash::make('12345678'),
                'role' => 5,
                'department_code' => 500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Alla',
                'email' => 'alla@kkyo.org',
                'password' => Hash::make('12345678'),
                'role' => 6,
                'department_code' => 600,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
