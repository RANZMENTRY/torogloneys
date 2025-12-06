<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssignRolesToUsersSeeder extends Seeder
{
    public function run(): void
    {
        // Assign admin role to admin user
        $adminUser = User::where('email', 'admin@torogloneys.com')->first();
        if ($adminUser) {
            $adminRole = Role::where('name', 'admin')->first();
            if ($adminRole) {
                // Clear existing roles
                DB::table('model_has_roles')
                    ->where('model_id', $adminUser->id)
                    ->where('model_type', User::class)
                    ->delete();
                
                // Insert new role
                DB::table('model_has_roles')->insert([
                    'model_type' => User::class,
                    'model_id' => $adminUser->id,
                    'role_id' => $adminRole->id,
                ]);
                $this->command->info("Assigned admin role to admin@torogloneys.com");
            }
        }

        // Assign staff role to john user
        $staffUser = User::where('email', 'john@example.com')->first();
        if ($staffUser) {
            $staffRole = Role::where('name', 'staff')->first();
            if ($staffRole) {
                // Clear existing roles
                DB::table('model_has_roles')
                    ->where('model_id', $staffUser->id)
                    ->where('model_type', User::class)
                    ->delete();
                
                // Insert new role
                DB::table('model_has_roles')->insert([
                    'model_type' => User::class,
                    'model_id' => $staffUser->id,
                    'role_id' => $staffRole->id,
                ]);
                $this->command->info("Assigned staff role to john@example.com");
            }
        }
    }
}
