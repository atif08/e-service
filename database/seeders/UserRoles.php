<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRoles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit certified user']);
        Permission::create(['name' => 'delete certified user']);

        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['name' => 'manager'])->givePermissionTo(Permission::all());

        // or may be done by chaining
        $role = Role::create(['name' => 'employee'])
            ->givePermissionTo(['edit certified user']);

    }
}
