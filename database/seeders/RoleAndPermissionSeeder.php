<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Permissions\Permission as Rights;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => Rights::CAN_VIEW_USERS]);
        Permission::create(['name' => Rights::CAN_CREATE_USERS]);
        Permission::create(['name' => Rights::CAN_UPDATE_USERS]);
        Permission::create(['name' => Rights::CAN_DELETE_USERS]);

        Permission::create(['name' =>  Rights::CAN_VIEW_CATEGORIES]);
        Permission::create(['name' =>  Rights::CAN_CREATE_CATEGORIES]);
        Permission::create(['name' => Rights::CAN_UPDATE_CATEGORIES]);
        Permission::create(['name' => Rights::CAN_DELETE_CATEGORIES]);

        Permission::create(['name' => Rights::CAN_VIEW_SETTINGS]);
        Permission::create(['name' => Rights::CAN_UPDATE_SETTINGS]);

        $superAdminRole = Role::create(['name' => 'Super Admin']);
        $adminRole = Role::create(['name' => 'Admin']);
        $managerRole = Role::create(['name' => 'Manager']);
        $cashierRole = Role::create(['name' => 'Cashier']);

        // $superAdminRole = Role::find(1);
        // $adminRole = Role::find(2);
        // $managerRole = Role::find(2);


        $superAdminRole->givePermissionTo([
            Rights::CAN_VIEW_USERS,
            Rights::CAN_CREATE_USERS,
            Rights::CAN_UPDATE_USERS,
            Rights::CAN_DELETE_USERS,
            Rights::CAN_VIEW_CATEGORIES,
            Rights::CAN_CREATE_CATEGORIES,
            Rights::CAN_UPDATE_CATEGORIES,
            Rights::CAN_DELETE_CATEGORIES,
            Rights::CAN_VIEW_SETTINGS,
            Rights::CAN_UPDATE_SETTINGS,
        ]);

        $adminRole->givePermissionTo([
            Rights::CAN_VIEW_USERS,
            Rights::CAN_CREATE_USERS,
            Rights::CAN_UPDATE_USERS,
            Rights::CAN_DELETE_USERS,
            Rights::CAN_VIEW_CATEGORIES,
            Rights::CAN_CREATE_CATEGORIES,
            Rights::CAN_UPDATE_CATEGORIES,
            Rights::CAN_DELETE_CATEGORIES,
        ]);

        $managerRole->givePermissionTo([
            Rights::CAN_VIEW_CATEGORIES,
            Rights::CAN_CREATE_CATEGORIES,
            Rights::CAN_UPDATE_CATEGORIES,
            Rights::CAN_DELETE_CATEGORIES,
        ]);
    }
}
