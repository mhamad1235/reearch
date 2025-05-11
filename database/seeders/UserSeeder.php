<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userRole = Role::firstOrCreate(['name' => 'user']);

        for ($i = 1; $i <= 20; $i++) {
            $name = "Student {$i}";
            $email = "student{$i}@example.com";
            $assignedClass = $i <= 10 ? ["Class A - Morning"] : ["Class B - Evening"];

            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => $name,
                    'password' => Hash::make('password'),
                    'department_id' => 1,
                    'class' => 1,
                    'assigned_classes' => $assignedClass,
                ]
            );

            $user->assignRole($userRole);
        }
    
    }
}
