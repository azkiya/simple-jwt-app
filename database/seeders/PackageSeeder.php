<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PackageSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Loop untuk menambahkan beberapa data
        foreach (range(1, 50) as $index) {
            DB::table('packages')->insert([
                'order_id' => rand(1, 100),
                'courier' => rand(1, 10),
                'name' => $faker->name,
                'address' => $faker->address,
                'destination' => rand(1, 100),
                'origin' => rand(1, 100),
                'weight' => $this->generateWeight(),
                'created_at' => now(),
            ]);
        }
    }

    // Method untuk menghasilkan weight dalam kelipatan 500 (gram)
    private function generateWeight()
    {
        return (int) (rand(1000, 5000) / 500) * 500;
    }
}
