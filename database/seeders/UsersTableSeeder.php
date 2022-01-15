<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '01098591011',
            'country' => 'Egypt',
            'password' => Hash::make('123123'),
            'type' => 'admin',
        ]);

        $role = Role::create([
            'name' => User::SuperAdminRole,
        ]);

        $user->assignRole($role);
    }
}
