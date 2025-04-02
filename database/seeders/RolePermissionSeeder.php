<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permissions = [
            'manage statistics',
            'manage products',
            'manage principals',
            'manage testimonials',
            'manage clients',
            'manage teams',
            'manage abouts',
            'manage appointments',
            'manage hero sections',
        ];

        foreach ($permissions as $permission) {
            Permission::firstorCreate([
                'name' => $permission,
            ]);
        }

        $designManagerRole = Role::firstOrCreate([
            'name' => 'design_manager',
        ]);
        $designManagerPermissions = [
            'manage products',
            'manage principals',
            'manage testimonials',
        ];
        $designManagerRole->syncPermissions($designManagerPermissions);


        $superAdminRole = Role::firstOrCreate([
            'name' => 'super_admin',
        ]);
        $superAdminRole->syncPermissions($permissions);

        $user = User::create([
            'name' => 'rifai',
            'email' => 'rnrifai12@gmail.com',
            'password' => bcrypt('123123123'),
        ]); // Added missing semicolon here

        $user->assignRole($superAdminRole);
    }
}
