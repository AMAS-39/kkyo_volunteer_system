<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('departments')->insert([
            [
                'name' => 'Technology and Innovation',
                'code' => 200,
                'head_name' => 'Ahmad',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Culture',
                'code' => 300,
                'head_name' => 'Bala',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Education',
                'code' => 400,
                'head_name' => 'Ashna',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Media',
                'code' => 500,
                'head_name' => 'Sarezh',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Economy',
                'code' => 600,
                'head_name' => 'Alla',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
