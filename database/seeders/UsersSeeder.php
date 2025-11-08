<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        // 👤 Admin User
        DB::table('users')->insert([
            'username' => 'admin',
            'email' => 'admin@ttcl.co.tz',
            'password' => Hash::make('admin1234'),
            'role' => 'admin',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 👥 Sample Customers
        DB::table('users')->insert([
            [
                'username' => 'Rafael_kitila',
                'email' => 'rafael@customer.com',
                'password' => Hash::make('rafael123'),
                'role' => 'manager',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'Joyce_daniel',
                'email' => 'joyce@customer.com',
                'password' => Hash::make('joyce123'),
                'role' => 'customer',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
