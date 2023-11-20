<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
                'name' => 'customer',
                'is_admin' => 0,
                'email' => 'customer@demo.com',
                'password' => bcrypt('password123'),
            ]);

        User::create([
            'name' => 'admin',
            'is_admin' => 1,
            'email' => 'admin@demo.com',
            'password' => bcrypt('password123'),
        ]);
    }
}
