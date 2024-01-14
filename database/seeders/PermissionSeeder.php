<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Permission;
use App\Models\Resource;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dashboardModule = Resource::updateOrCreate(['name'=>'Admin Dashboard']);

        Permission::updateOrCreate([
            'resource_id' =>  $dashboardModule->id,
            'name'      =>  'Access Dashboard',
            'slug'      =>  'access-dashboard',
        ]);

        $roleModule = Module::updateOrCreate(['name'=>'Role Management']);

        Permission::updateOrCreate([
            'resource_id' =>  $roleModule->id,
            'name'      =>  'Role Index',
            'slug'      =>  'role-index',
        ]);
        Permission::updateOrCreate([
            'resource_id' =>  $roleModule->id,
            'name'      =>  'Role Create',
            'slug'      =>  'role-create',
        ]);
        Permission::updateOrCreate([
            'resource_id' =>  $roleModule->id,
            'name'      =>  'Role Edit',
            'slug'      =>  'role-edit',
        ]);
        Permission::updateOrCreate([
            'resource_id' =>  $roleModule->id,
            'name'      =>  'Role Update',
            'slug'      =>  'role-update',
        ]);
        Permission::updateOrCreate([
            'resource_id' =>  $roleModule->id,
            'name'      =>  'Role Delete',
            'slug'      =>  'role-delete',
        ]);

        $resourceModule = Resource::updateOrCreate(['name'=>'User Management']);

        Permission::updateOrCreate([
            'resource_id' =>  $resourceModule->id,
            'name'      =>  'User Index',
            'slug'      =>  'user-index',
        ]);
        Permission::updateOrCreate([
            'resource_id' =>  $resourceModule->id,
            'name'      =>  'User Create',
            'slug'      =>  'user-create',
        ]);
        Permission::updateOrCreate([
            'resource_id' =>  $resourceModule->id,
            'name'      =>  'User Edit',
            'slug'      =>  'user-edit',
        ]);
        Permission::updateOrCreate([
            'resource_id' =>  $resourceModule->id,
            'name'      =>  'User Update',
            'slug'      =>  'user-update',
        ]);
        Permission::updateOrCreate([
            'resource_id' =>  $resourceModule->id,
            'name'      =>  'User Delete',
            'slug'      =>  'user-delete',
        ]);
    }
}
