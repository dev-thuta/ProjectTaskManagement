<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'id' => 1,
                'name' => 'Admin',
                'description' => 'System administrator'
            ],
            [
                'id' => 2,
                'name' => 'User',
                'description' => 'General user'
            ],
            [
                'id' => 3,
                'name' => 'Manager',
                'description' => 'Manages teams'
            ],
            [
                'id' => 4,
                'name' => 'Project Manager',
                'description' => 'Oversees projects'
            ],
        ]);
    }
}
