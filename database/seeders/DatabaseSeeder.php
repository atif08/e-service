<?php

namespace Database\Seeders;

use App\Enums\CertifiedUserStatusEnum;
use App\Models\Account;
use App\Models\CertifiedUserApplication;
use App\Models\Contact;
use App\Models\Organization;
use App\Models\Price;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserRoles::class);
        $this->call(CountrySeeder::class);
        $this->call(UniversitySeeder::class);

        $user = User::create([
            'first_name' => 'admin',
            'last_name' => 'user',
            'email' => 'admin@example.com',
            'password' => '12345678',
        ]);

        $user->syncRoles(['manager']);

        $user = User::create([
            'first_name' => 'emp',
            'last_name' => 'user',
            'email' => 'employee@example.com',
            'password' => '12345678',
        ]);

        $user->syncRoles(['employee']);

        Price::factory(5)->create(); // Create 10 price records
        CertifiedUserApplication::factory(10)->create(['status'=>CertifiedUserStatusEnum::NEW]); // Create 10 certified user applications with 'new' status
        CertifiedUserApplication::factory(10)->create(['status'=>CertifiedUserStatusEnum::APPROVED]); // Create 10 certified user applications with 'new' status
        CertifiedUserApplication::factory(10)->create(['status'=>CertifiedUserStatusEnum::INITIAL_ACCEPTANCE]); // Create 10 certified user applications with 'new' status
        CertifiedUserApplication::factory(10)->create(['status'=>CertifiedUserStatusEnum::REJECTED]); // Create 10 certified user applications with 'new' status





    }
}
