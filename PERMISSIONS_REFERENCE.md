# Permission Reference

## Complete Permission Listing

### Dashboard Module (1 permission)
| Permission | Description | Admin | Staff |
|------------|-------------|-------|-------|
| view_dashboard | View dashboard | ✅ | ✅ |

### Categories Module (4 permissions)
| Permission | Description | Admin | Staff |
|------------|-------------|-------|-------|
| view_categories | View categories | ✅ | ✅ |
| create_categories | Create categories | ✅ | ❌ |
| edit_categories | Edit categories | ✅ | ✅ |
| delete_categories | Delete categories | ✅ | ❌ |

### Products Module (4 permissions)
| Permission | Description | Admin | Staff |
|------------|-------------|-------|-------|
| view_products | View products | ✅ | ✅ |
| create_products | Create products | ✅ | ❌ |
| edit_products | Edit products | ✅ | ✅ |
| delete_products | Delete products | ✅ | ❌ |

### Orders Module (4 permissions)
| Permission | Description | Admin | Staff |
|------------|-------------|-------|-------|
| view_orders | View orders | ✅ | ✅ |
| create_orders | Create orders | ✅ | ❌ |
| edit_orders | Edit orders | ✅ | ✅ |
| delete_orders | Delete orders | ✅ | ❌ |

### Users Module (4 permissions)
| Permission | Description | Admin | Staff |
|------------|-------------|-------|-------|
| view_users | View users | ✅ | ✅ |
| create_users | Create users | ✅ | ❌ |
| edit_users | Edit users | ✅ | ✅ |
| delete_users | Delete users | ✅ | ❌ |

### Settings Module (2 permissions)
| Permission | Description | Admin | Staff |
|------------|-------------|-------|-------|
| view_settings | View settings | ✅ | ❌ |
| edit_settings | Edit settings | ✅ | ❌ |

## Summary

**Total Permissions**: 19
- **Dashboard**: 1 permission
- **Categories**: 4 permissions
- **Products**: 4 permissions
- **Orders**: 4 permissions
- **Users**: 4 permissions
- **Settings**: 2 permissions

**Role Breakdown**:
- **Admin Role**: 19 permissions (all)
- **Staff Role**: 9 permissions (view + edit for main modules, no settings)

## Permission Naming Convention

### Pattern: `{action}_{resource}`

**Actions**:
- `view_` - Read-only access
- `create_` - Create new records
- `edit_` - Modify existing records
- `delete_` - Remove records

**Resources**:
- `dashboard` - Admin dashboard
- `categories` - Product categories
- `products` - Products/Aglonema plants
- `orders` - Customer orders
- `users` - Admin users
- `settings` - System settings

## Adding New Permissions

To add new permissions, follow this pattern:

1. **Update PermissionSeeder.php**:
```php
Permission::create([
    'name' => 'export_users',
    'description' => 'Export users to file',
    'module' => 'Users',
    'guard_name' => 'web',
]);
```

2. **Assign to Role** (in RoleSeeder):
```php
$adminRole->permissions()->attach(
    Permission::where('name', 'export_users')->first()
);
```

3. **Check Permission** (in resource):
```php
if ($user->hasPermission('export_users')) {
    // Allow export
}
```

## Permission Module Mapping

| Module | Resource | Database Table | Guard |
|--------|----------|-----------------|-------|
| Dashboard | Dashboard | N/A (widget-based) | web |
| Categories | CategoryResource | categories | web |
| Products | ProductResource | products | web |
| Orders | OrderResource | orders | web |
| Users | UserResource | users | web |
| Settings | SettingsResource | N/A (config-based) | web |

## Guard Names

All permissions use the `web` guard for standard Filament admin access.

**Available Guards**:
- `web` - Web application (Filament admin panel)
- `api` - API access (future use)

## Resource-Permission Mapping

| Resource | view_* | create_* | edit_* | delete_* |
|----------|--------|----------|--------|----------|
| UserResource | view_users | create_users | edit_users | delete_users |
| CategoryResource | view_categories | create_categories | edit_categories | delete_categories |
| ProductResource | view_products | create_products | edit_products | delete_products |
| OrderResource | view_orders | create_orders | edit_orders | delete_orders |
| RoleResource | N/A (admin only) | N/A (admin only) | N/A (admin only) | N/A (admin only) |
| PermissionResource | N/A (admin only) | N/A (admin only) | N/A (admin only) | N/A (admin only) |

## Checking Permissions in Code

### Single Permission
```php
if (Auth::user()->hasPermission('view_users')) {
    // Show users
}
```

### Multiple Permissions (Any)
```php
if (Auth::user()->hasAnyPermission(['create_users', 'edit_users'])) {
    // User can create or edit users
}
```

### Multiple Permissions (All)
```php
if (Auth::user()->hasAllPermissions(['view_users', 'edit_users', 'delete_users'])) {
    // User can manage users completely
}
```

### Role Check
```php
if (Auth::user()->hasRole('admin')) {
    // Admin only feature
}
```

## Filament Resource Protection Example

```php
class UserResource extends Resource
{
    // Check if user can access resource at all
    public static function canAccess(): bool
    {
        $user = Auth::user();
        return $user->hasRole('admin') || $user->hasPermission('view_users');
    }
    
    // Check if user can create new records
    public static function canCreate(): bool
    {
        return Auth::user()->hasPermission('create_users');
    }
    
    // Check if user can edit a specific record
    public static function canEdit(Model $record): bool
    {
        return Auth::user()->hasPermission('edit_users');
    }
    
    // Check if user can delete a specific record
    public static function canDelete(Model $record): bool
    {
        return Auth::user()->hasPermission('delete_users');
    }
    
    // Hide from navigation if no access
    public static function shouldRegisterNavigation(): bool
    {
        return static::canAccess();
    }
}
```

## Permissions by Module

### Dashboard
- Used for dashboard access control
- Staff users have view_dashboard
- Minimal permissions (read-only)

### Categories
- Standard CRUD permissions
- Staff can view and edit (not create/delete)
- Used for plant category management

### Products  
- Standard CRUD permissions
- Staff can view and edit (not create/delete)
- Used for plant product management

### Orders
- Standard CRUD permissions
- Staff can view and edit (not create/delete)
- Used for customer order management

### Users
- Standard CRUD permissions
- Staff can view and edit users (not create/delete)
- Staff can manage non-admin users only

### Settings
- Limited permissions (view/edit only)
- Admin only access
- No create/delete for settings

---

**Last Updated**: December 2025
**Permission Count**: 19
**Role Count**: 2
**Version**: 1.0
