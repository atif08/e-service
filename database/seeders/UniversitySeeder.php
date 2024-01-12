<?php

namespace Database\Seeders;

use App\Models\University;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        University::create([
            'name' => 'Beaconhouse national university',
            'slug' => Str::slug('beaconhouse national university')
        ]);

        University::create([
            'name' => 'Information Technology University',
            'slug' => Str::slug('Information Technology University')
        ]);
    }
}
