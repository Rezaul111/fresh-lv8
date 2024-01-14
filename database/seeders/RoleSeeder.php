<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminPermissions = Permission::all();

        Role::updateOrCreate([
            'name'          =>  'Admin',
            'slug'          =>  'admin',
            'inserted_by'   =>  1
        ]);
//
//        Role::updateOrCreate([
//            'name'  =>  'User',
//            'slug'  =>  'user',
//        ]);

    }
}
