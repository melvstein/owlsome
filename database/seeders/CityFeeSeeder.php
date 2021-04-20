<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CityShippingFee;

class CityFeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CityShippingFee::create([
            'city' => "Muntinlupa City",
            'shipping_fee' => 50,
        ]);
    }
}
