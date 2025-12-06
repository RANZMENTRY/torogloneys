<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Admin Role - All permissions
        $adminRole = Role::firstOrCreate(
            ['name' => 'admin', 'guard_name' => 'web'],
            ['description' => 'Administrator with all permissions']
        );

        // Assign all permissions to admin
        $allPermissions = Permission::all();
        $adminRole->permissions()->sync($allPermissions->pluck('id')->toArray());

        // Staff Role - Limited permissions (view & update only)
        $staffRole = Role::firstOrCreate(
            ['name' => 'staff', 'guard_name' => 'web'],
            ['description' => 'Staff member with limited permissions']
        );

        // Get only view and update permissions (not create, delete, or settings)
        $staffPermissions = Permission::whereIn('name', [
            'view_dashboard',
            'view_categories',
            'view_products',
            'view_orders',
            'view_users',
            'edit_categories',
            'edit_products',
            'edit_orders',
            'edit_users',
        ])->pluck('id')->toArray();

        $staffRole->permissions()->sync($staffPermissions);
    }
}
