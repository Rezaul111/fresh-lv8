<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate([
            'name'          =>  'Admin',
            'email'         =>  'admin@mail.com',
            'password'      =>   Hash::make('password'),
            'mobile'        =>  '01812345678',
            'user_type'     =>  'admin',
        ]);

//        User::updateOrCreate([
//            'name'          =>  'User',
//            'email'         =>  'user@mail.com',
//            'password'      =>   Hash::make('password'),
//            'mobile'        =>  '0181333444',
//            'user_type'     =>  'user',
//        ]);
    }
}
