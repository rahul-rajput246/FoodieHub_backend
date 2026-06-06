<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Seed roles and a default admin user.
     */
    public function run(): void
    {
        
        /** for fresh data */
        
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        $admin = User::firstOrCreate(
            ['email' => 'rahulrajput20112005@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('12345678'),
                'email_verified_at' => now(),
            ]
        );

        if (! $admin->hasRole($adminRole)) {
            $admin->assignRole($adminRole);
        }

        $normalUser = User::firstOrCreate(
            ['email' => 'rahulrajput226644@gmail.com'],
            [   
                'name' => 'Rahul User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        if (! $normalUser->hasRole($userRole)) {
            $normalUser->assignRole($userRole);
        }
    }
}
