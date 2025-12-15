<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name'=> "Admin"]);
        $client = Role::create(['name'=> "Client"]);

        $dashboard = Permission::create(['name'=> 'dashboard']);

        $productList = Permission::create(['name'=> 'productList']);
        $productCreate = Permission::create(['name'=> 'productCreate']);

        $admin->givePermissionTo([
            $dashboard,
            $productList,
            $productCreate,
        ]);

        $client->givePermissionTo([
             $productList
        ]);
    }
}
