<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::create([
            'name' => 'United State',
            'code' => 'us'
        ]);

        Country::create([
            'name' => 'Pakistan',
            'code' => 'pk'
        ]);
    }
}
