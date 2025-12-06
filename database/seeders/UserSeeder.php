<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'john@example.com'],
            [
                'name' => 'John Doe',
                'password' => bcrypt('password123'),
                'active' => true,
            ]
        );

        // Assign admin role using direct insert with model_type
        $adminRole = Role::where('name', 'admin')->first();
        if ($adminRole) {
            DB::table('model_has_roles')->updateOrInsert(
                [
                    'role_id' => $adminRole->id,
                    'model_id' => $user->id,
                    'model_type' => User::class,
                ]
            );
        }
    }
}
