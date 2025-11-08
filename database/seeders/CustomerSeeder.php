<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            ['name' => 'John Doe', 'phone' => '0712345678', 'email' => 'john@example.com', 'address' => 'Dodoma City Center'],
            ['name' => 'Mary Joseph', 'phone' => '0759876543', 'email' => 'mary@example.com', 'address' => 'University of Dodoma'],
            ['name' => 'Peter Kamau', 'phone' => '0682334455', 'email' => 'peter@example.com', 'address' => 'Mlimwa Area'],
            ['name' => 'Alice David', 'phone' => '0765544332', 'email' => 'alice@example.com', 'address' => 'Area C, Dodoma'],
            ['name' => 'George Mushi', 'phone' => '0744332211', 'email' => 'george@example.com', 'address' => 'Area D, Dodoma'],
        ];

        foreach ($customers as $data) {
            Customer::create($data);
        }
    }
}
