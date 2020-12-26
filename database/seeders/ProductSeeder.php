<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Service;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory()
            ->has(Service::factory()->count(2))
            ->count(5)->create();
    }
}
