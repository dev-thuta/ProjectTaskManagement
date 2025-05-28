<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('states')->insert([
            ['name' => 'Yangon', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mandalay', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sagaing', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bago', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Magway', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tanintharyi', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ayeyarwady', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kachin', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kayah', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kayin', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mon', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rakhine', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Shan', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Chin', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
