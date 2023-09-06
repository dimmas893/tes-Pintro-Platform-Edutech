<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Address;
use App\Models\Phone;
use App\Models\Role;
use App\Models\userRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $userAdmin = \App\Models\User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('sercret'),
            'password_asli' => 'sercret'
        ]);
        Address::create([
            'user_id' => $userAdmin->id,
            'name' => 'alamat 1'
        ]);
        Address::create([
            'user_id' => $userAdmin->id,
            'name' => 'alamat 2'
        ]);
        Phone::create([
            'user_id' => $userAdmin->id,
            'phone' => '081392396892'
        ]);

        $userEmployee = \App\Models\User::create([
            'name' => 'employee',
            'email' => 'employee@gmail.com',
            'password' => Hash::make('sercret'),
            'password_asli' => 'sercret'
        ]);

        Phone::create([
            'user_id' => $userEmployee->id,
            'phone' => '081392396892'
        ]);
        Address::create([
            'user_id' => $userEmployee->id,
            'name' => 'alamat 1'
        ]);
        Address::create([
            'user_id' => $userEmployee->id,
            'name' => 'alamat 2'
        ]);

        userRole::create([
            'user_id' => $userEmployee->id,
            'role_id' => 1
        ]);
        userRole::create([
            'user_id' => $userEmployee->id,
            'role_id' => 2
        ]);

        userRole::create([
            'user_id' => $userAdmin->id,
            'role_id' => 1
        ]);
        userRole::create([
            'user_id' => $userAdmin->id,
            'role_id' => 3
        ]);
        userRole::create([
            'user_id' => $userAdmin->id,
            'role_id' => 2
        ]);

        Role::create([
            'name' => 'super admin',
        ]);
        Role::create([
            'name' => 'admin',
        ]);
        Role::create([
            'name' => 'employee',
        ]);
    }
}
