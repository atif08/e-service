<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Contact;
use App\Models\Organization;
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




    }
}
