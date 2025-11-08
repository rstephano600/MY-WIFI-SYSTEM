<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Router;
use App\Models\Customer;
use Carbon\Carbon;

class RouterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = Customer::all();

        $routers = [
            [
                'serial_number' => 'TTCL-RTR-1001',
                'model' => 'Huawei B310s',
                'wifi_name' => 'TTCL_Home_1001',
                'wifi_password' => '12345678',
                'status' => 'active',
                'registered_date' => Carbon::now()->subDays(15),
            ],
            [
                'serial_number' => 'TTCL-RTR-1002',
                'model' => 'ZTE MF283+',
                'wifi_name' => 'TTCL_Office_1002',
                'wifi_password' => '87654321',
                'status' => 'active',
                'registered_date' => Carbon::now()->subDays(10),
            ],
            [
                'serial_number' => 'TTCL-RTR-1003',
                'model' => 'Huawei B525',
                'wifi_name' => 'TTCL_User_1003',
                'wifi_password' => 'password123',
                'status' => 'inactive',
                'registered_date' => Carbon::now()->subDays(30),
            ],
            [
                'serial_number' => 'TTCL-RTR-1004',
                'model' => 'ZTE MF286R',
                'wifi_name' => 'TTCL_Router_1004',
                'wifi_password' => 'changeme',
                'status' => 'active',
                'registered_date' => Carbon::now()->subDays(7),
            ],
            [
                'serial_number' => 'TTCL-RTR-1005',
                'model' => 'Huawei B818',
                'wifi_name' => 'TTCL_Speed_1005',
                'wifi_password' => 'wifi@2025',
                'status' => 'active',
                'registered_date' => Carbon::now()->subDays(3),
            ],
        ];

        foreach ($routers as $index => $data) {
            $data['customer_id'] = $customers[$index % $customers->count()]->id ?? null;
            Router::create($data);
        }
    }
}
