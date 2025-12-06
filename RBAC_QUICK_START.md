# RBAC Quick Start Guide

## Login Credentials

### Admin Account
- **URL**: http://127.0.0.1:8000/admin
- **Email**: admin@torogloneys.com
- **Password**: password123
- **Access**: Full system access to all resources and role management

### Staff Account (for testing limited access)
- **Email**: john@example.com
- **Password**: See UserSeeder for password
- **Access**: Can view and edit Categories, Products, Orders, Users (no create/delete, no role management)

## What Changed

### Resources Now Protected
1. ✅ **Users** - Full CRUD with role assignment
2. ✅ **Categories** - Full CRUD
3. ✅ **Products** - Full CRUD
4. ✅ **Roles** - Admin only (Staff cannot access)
5. ✅ **Permissions** - Admin only (Staff cannot access)

### Navigation Behavior
- Menu items automatically hide for users without `view_*` permission
- Staff users see 7 menu items (missing Roles & Permissions)
- Admin users see all 9 menu items

### Action Buttons
- **Create** button hidden/disabled if user lacks `create_*` permission
- **Edit** button disabled if user lacks `edit_*` permission
- **Delete** button disabled if user lacks `delete_*` permission

## Testing the System

### Test as Admin
1. Login with admin@torogloneys.com
2. All menu items visible: Dashboard, Categories, Products, Orders, Users, Roles, Permissions
3. All action buttons available (Create, Edit, Delete)
4. Can manage roles and permissions

### Test as Staff
1. Logout from admin account
2. Login with john@example.com (use password from UserSeeder)
3. Limited menu items visible: Dashboard, Categories, Products, Orders, Users
4. **Can**: View all records, Edit records
5. **Cannot**: Create new records, Delete records, Manage roles/permissions

## Checking Permissions in Code

### In Controllers/Models
```php
use Illuminate\Support\Facades\Auth;

$user = Auth::user();

// Single permission check
if ($user->hasPermission('create_users')) {
    // Allow action
}

// Multiple permissions (any match)
if ($user->hasAnyPermission(['create_users', 'create_categories'])) {
    // Allow if user has either permission
}

// Multiple permissions (all match)
if ($user->hasAllPermissions(['view_users', 'edit_users', 'delete_users'])) {
    // Allow if user has all three permissions
}

// Role check
if ($user->hasRole('admin')) {
    // Admin-only action
}
```

### In Filament Resources
```php
use Illuminate\Support\Facades\Auth;
use App\Models\User;

public static function canAccess(): bool
{
    $user = Auth::user();
    
    if (!$user instanceof User) {
        return false;
    }
    
    // Admin has full access, others need specific permission
    return $user->hasRole('admin') || $user->hasPermission('view_resource');
}

public static function shouldRegisterNavigation(): bool
{
    return static::canAccess(); // Hide from nav if no access
}
```

## Common Scenarios

### Scenario 1: Restrict Feature to Admins Only
```php
if (Auth::user()->hasRole('admin')) {
    // Show admin feature
}
```

### Scenario 2: Show Different UI Based on Permissions
```php
$user = Auth::user();

if ($user->hasPermission('edit_users')) {
    // Show edit buttons
} elseif ($user->hasPermission('view_users')) {
    // Show read-only view
} else {
    // No access
    abort(403);
}
```

### Scenario 3: Bulk Permission Checks
```php
$user = Auth::user();

$canManageUsers = $user->hasAllPermissions([
    'view_users',
    'create_users',
    'edit_users',
    'delete_users'
]);

if ($canManageUsers) {
    // Full user management capability
}
```

## Database

### View All Permissions
```sql
SELECT name, module FROM permissions ORDER BY module;
```

### View All Roles
```sql
SELECT * FROM roles;
```

### View User Roles
```sql
SELECT u.email, r.name 
FROM users u
LEFT JOIN model_has_roles mhr ON u.id = mhr.model_id
LEFT JOIN roles r ON mhr.role_id = r.id
WHERE mhr.model_type = 'App\\Models\\User';
```

### View Role Permissions
```sql
SELECT r.name, p.name, p.module
FROM roles r
LEFT JOIN role_has_permissions rhp ON r.id = rhp.role_id
LEFT JOIN permissions p ON rhp.permission_id = p.id
ORDER BY r.name, p.module;
```

## Troubleshooting

### User Cannot Access Resource
1. Check if user has required `view_*` permission via Users resource
2. Verify user has correct role assigned
3. Confirm role has necessary permissions

### Create Button Not Showing
- User lacks `create_*` permission for that resource
- Only available to admins or users with explicit permission

### Menu Item Not Visible
- User lacks `view_*` permission for that resource
- Check user's role and role's permissions

### Permission Not Taking Effect
- Clear Laravel cache: `php artisan cache:clear`
- Check that user is properly assigned to role
- Verify permission name matches exactly

## Admin Operations

### Create New Role
1. Login as admin
2. Go to Admin → Roles
3. Click "Create" button
4. Enter role name
5. Select permissions (grouped by module)
6. Save

### Assign Permissions to Existing Role
1. Go to Admin → Roles
2. Click edit icon on role
3. Check/uncheck permissions as needed
4. Save

### Create New User
1. Go to Admin → Users
2. Click "Create" button
3. Enter name, email, password
4. Select role (checkbox)
5. Toggle active status
6. Save

### Change User Role
1. Go to Admin → Users
2. Click edit icon on user
3. Uncheck current role checkbox
4. Check new role checkbox
5. Save

## Advanced: Adding New Permissions

### Option 1: Manual Database Insert
```sql
INSERT INTO permissions (name, module, description, guard_name)
VALUES ('action_resource', 'Module', 'Description', 'web');
```

### Option 2: Via Seeder (Recommended)
1. Edit `database/seeders/PermissionSeeder.php`
2. Add permission to array in run() method
3. Run: `php artisan db:seed --class=PermissionSeeder`

### Option 3: Create Custom Seeder
```php
<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class AddNewPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        Permission::create([
            'name' => 'export_users',
            'module' => 'Users',
            'description' => 'Export users to file',
            'guard_name' => 'web',
        ]);
    }
}
```

## Performance Notes

- Permission checks use cached model relationships
- Admin role bypasses permission checks automatically
- No database queries for admin role permission checks
- Staff users trigger role→permission queries

## Security Reminders

✅ **DO:**
- Always check permissions in resource canAccess() methods
- Verify permissions on backend even if hidden in UI
- Use hasPermission() for feature flags
- Assign specific permissions, not blanket admin

❌ **DON'T:**
- Trust only frontend permission checks
- Allow users to modify their own roles
- Hardcode usernames/emails for access
- Store sensitive data in permissions name field
