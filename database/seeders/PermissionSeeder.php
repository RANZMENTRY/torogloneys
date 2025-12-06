<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // Dashboard
            ['name' => 'view_dashboard', 'module' => 'Dashboard', 'description' => 'View dashboard'],
            
            // Categories
            ['name' => 'view_categories', 'module' => 'Categories', 'description' => 'View categories'],
            ['name' => 'create_categories', 'module' => 'Categories', 'description' => 'Create categories'],
            ['name' => 'edit_categories', 'module' => 'Categories', 'description' => 'Edit categories'],
            ['name' => 'delete_categories', 'module' => 'Categories', 'description' => 'Delete categories'],
            
            // Products
            ['name' => 'view_products', 'module' => 'Products', 'description' => 'View products'],
            ['name' => 'create_products', 'module' => 'Products', 'description' => 'Create products'],
            ['name' => 'edit_products', 'module' => 'Products', 'description' => 'Edit products'],
            ['name' => 'delete_products', 'module' => 'Products', 'description' => 'Delete products'],
            
            // Orders
            ['name' => 'view_orders', 'module' => 'Orders', 'description' => 'View orders'],
            ['name' => 'create_orders', 'module' => 'Orders', 'description' => 'Create orders'],
            ['name' => 'edit_orders', 'module' => 'Orders', 'description' => 'Edit orders'],
            ['name' => 'delete_orders', 'module' => 'Orders', 'description' => 'Delete orders'],
            
            // Users
            ['name' => 'view_users', 'module' => 'Users', 'description' => 'View users'],
            ['name' => 'create_users', 'module' => 'Users', 'description' => 'Create users'],
            ['name' => 'edit_users', 'module' => 'Users', 'description' => 'Edit users'],
            ['name' => 'delete_users', 'module' => 'Users', 'description' => 'Delete users'],
            
            // Settings
            ['name' => 'view_settings', 'module' => 'Settings', 'description' => 'View settings'],
            ['name' => 'edit_settings', 'module' => 'Settings', 'description' => 'Edit settings'],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission['name']],
                [
                    'guard_name' => 'web',
                    'module' => $permission['module'],
                    'description' => $permission['description'],
                ]
            );
        }

        // Create Admin role with all permissions
        $adminRole = Role::firstOrCreate(
            ['name' => 'admin'],
            ['guard_name' => 'web', 'description' => 'Administrator with all permissions']
        );

        $adminPermissions = Permission::all();
        $adminRole->permissions()->sync($adminPermissions->pluck('id')->toArray());

        // Create User role with limited permissions
        $userRole = Role::firstOrCreate(
            ['name' => 'user'],
            ['guard_name' => 'web', 'description' => 'Regular user with limited permissions']
        );

        $userPermissions = Permission::whereIn('name', [
            'view_dashboard',
            'view_categories',
            'view_products',
            'view_orders',
        ])->get();

        $userRole->permissions()->sync($userPermissions->pluck('id')->toArray());
    }
}
