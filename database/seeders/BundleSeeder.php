<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bundle;

class BundleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bundles = [
            [
                'name' => '1GB Daily Plan',
                'data_size_gb' => 1,
                'duration_days' => 1,
                'price' => 1000,
                'description' => 'Perfect for light daily browsing and social media.',
            ],
            [
                'name' => '2GB 3-Day Plan',
                'data_size_gb' => 2,
                'duration_days' => 3,
                'price' => 2500,
                'description' => 'Short-term plan ideal for short trips and temporary use.',
            ],
            [
                'name' => '5GB Weekly Plan',
                'data_size_gb' => 5,
                'duration_days' => 7,
                'price' => 7000,
                'description' => 'Great for regular internet users with moderate data needs.',
            ],
            [
                'name' => '10GB Weekly Plus',
                'data_size_gb' => 10,
                'duration_days' => 7,
                'price' => 12000,
                'description' => 'A top-up for active users needing more streaming and downloads.',
            ],
            [
                'name' => '20GB Monthly Plan',
                'data_size_gb' => 20,
                'duration_days' => 30,
                'price' => 25000,
                'description' => 'Perfect for families or small business users with consistent needs.',
            ],
            [
                'name' => '50GB Power Monthly',
                'data_size_gb' => 50,
                'duration_days' => 30,
                'price' => 50000,
                'description' => 'Designed for heavy users, streaming, and work-from-home setups.',
            ],
            [
                'name' => 'Unlimited Monthly Plan',
                'data_size_gb' => 9999,
                'duration_days' => 30,
                'price' => 90000,
                'description' => 'Enjoy unlimited access with no data caps for 30 days.',
            ],
            [
                'name' => 'Unlimited Premium Annual Plan',
                'data_size_gb' => 99999,
                'duration_days' => 365,
                'price' => 950000,
                'description' => 'Full-year unlimited data — best value for enterprises or heavy users.',
            ],
        ];

        foreach ($bundles as $bundle) {
            Bundle::create($bundle);
        }
    }
}
