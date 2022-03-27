<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
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
        $roles = [
            'name' => "Super Admin",
            'guard_name' => 'web'
        ];

        Role::create($roles);
        
        $user = [
            'name' => 'Admin',
            'email' => 'admin@dtlogics.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'status' => 1
        ];
        $created = User::create($user);
        $find = User::find(1);
        $role = Role::find(1);
        $find->syncRoles($role);
        $find->save();
    }
}
