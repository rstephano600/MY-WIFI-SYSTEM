<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subscription;
use App\Models\Bundle;
use App\Models\Customer;
use Carbon\Carbon;

class SubscriptionSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure we have bundles and customers
        $bundles = Bundle::all();
        $customers = Customer::all();

        if ($bundles->isEmpty() || $customers->isEmpty()) {
            $this->command->warn('⚠️ Please seed Bundles and Customers first.');
            return;
        }

        // Create realistic subscriptions
        foreach ($customers as $customer) {
            $bundle = $bundles->random();
            $start_date = Carbon::now()->subDays(rand(0, 10));
            $end_date = $start_date->copy()->addDays($bundle->duration_days);

            Subscription::create([
                'customer_id' => $customer->id,
                'bundle_id' => $bundle->id,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'remaining_data_gb' => rand(0, $bundle->data_size_gb),
                'status' => Carbon::now()->lessThan($end_date) ? 'active' : 'expired',
            ]);
        }
    }
}
