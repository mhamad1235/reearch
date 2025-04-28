<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class RolesAndUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define permissions
        $permissions = [
            'view reports',
            'manage users',
            'approve requests',
            'grade students',
            'submit assignments',
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $head = Role::firstOrCreate(['name' => 'head_of_department']);
        $teacher = Role::firstOrCreate(['name' => 'teacher']);
        $user = Role::firstOrCreate(['name' => 'user']);

        // Assign permissions to roles
        $admin->givePermissionTo($permissions); // all permissions

        $head->givePermissionTo([
            'view reports',
            'approve requests',
        ]);

        $teacher->givePermissionTo([
            'view reports',
            'grade students',
        ]);

        $user->givePermissionTo([
            'submit assignments',
        ]);

        // Create users and assign roles
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin User', 'password' => Hash::make('password')]
        );
        $adminUser->assignRole($admin);

        $headUser = User::firstOrCreate(
            ['email' => 'head@example.com'],
            ['name' => 'Head of Department', 'password' => Hash::make('password')]
        );
        $headUser->assignRole($head);

        $teacherUser = User::firstOrCreate(
            ['email' => 'teacher@example.com'],
            ['name' => 'Teacher User', 'password' => Hash::make('password')]
        );
        $teacherUser->assignRole($teacher);

        $regularUser = User::firstOrCreate(
            ['email' => 'user@example.com'],
            ['name' => 'Regular User', 'password' => Hash::make('password')]
        );
        $regularUser->assignRole($user);

    }
}
