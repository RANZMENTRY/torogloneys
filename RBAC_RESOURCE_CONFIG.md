# RBAC Resource Configuration

## Resource Permission Matrix

### UserResource
**Location**: `app/Filament/Resources/UserResource.php`

| Operation | Permission Required | Admin | Staff |
|-----------|-------------------|-------|-------|
| Access/View | `view_users` | ✅ | ✅ |
| Create | `create_users` | ✅ | ❌ |
| Edit | `edit_users` | ✅ | ✅ |
| Delete | `delete_users` | ✅ | ❌ |
| Navigation | `view_users` | ✅ | ✅ |

**Configuration**:
```php
public static function canAccess(): bool
{
    $user = Auth::user();
    if (!$user instanceof User) return false;
    return $user->hasRole('admin') || $user->hasPermission('view_users');
}

public static function canCreate(): bool
{
    $user = Auth::user();
    if (!$user instanceof User) return false;
    return $user->hasRole('admin') || $user->hasPermission('create_users');
}

public static function canEdit(Model $record): bool
{
    $user = Auth::user();
    if (!$user instanceof User) return false;
    return $user->hasRole('admin') || $user->hasPermission('edit_users');
}

public static function canDelete(Model $record): bool
{
    $user = Auth::user();
    if (!$user instanceof User) return false;
    return $user->hasRole('admin') || $user->hasPermission('delete_users');
}

public static function shouldRegisterNavigation(): bool
{
    return static::canAccess();
}
```

**Filament Pages**:
- `app/Filament/Resources/Users/Pages/ListUsers.php`
- `app/Filament/Resources/Users/Pages/CreateUser.php`
- `app/Filament/Resources/Users/Pages/EditUser.php`

---

### CategoryResource
**Location**: `app/Filament/Resources/Categories/CategoryResource.php`

| Operation | Permission Required | Admin | Staff |
|-----------|-------------------|-------|-------|
| Access/View | `view_categories` | ✅ | ✅ |
| Create | `create_categories` | ✅ | ❌ |
| Edit | `edit_categories` | ✅ | ✅ |
| Delete | `delete_categories` | ✅ | ❌ |
| Navigation | `view_categories` | ✅ | ✅ |

**Configuration**:
```php
public static function canAccess(): bool
{
    $user = Auth::user();
    if (!$user instanceof User) return false;
    return $user->hasRole('admin') || $user->hasPermission('view_categories');
}

public static function canCreate(): bool
{
    $user = Auth::user();
    if (!$user instanceof User) return false;
    return $user->hasRole('admin') || $user->hasPermission('create_categories');
}

public static function canEdit(Model $record): bool
{
    $user = Auth::user();
    if (!$user instanceof User) return false;
    return $user->hasRole('admin') || $user->hasPermission('edit_categories');
}

public static function canDelete(Model $record): bool
{
    $user = Auth::user();
    if (!$user instanceof User) return false;
    return $user->hasRole('admin') || $user->hasPermission('delete_categories');
}

public static function shouldRegisterNavigation(): bool
{
    return static::canAccess();
}
```

**Filament Pages**:
- `app/Filament/Resources/Categories/Pages/ListCategories.php`
- `app/Filament/Resources/Categories/Pages/CreateCategory.php`
- `app/Filament/Resources/Categories/Pages/EditCategory.php`

---

### ProductResource
**Location**: `app/Filament/Resources/Products/ProductResource.php`

| Operation | Permission Required | Admin | Staff |
|-----------|-------------------|-------|-------|
| Access/View | `view_products` | ✅ | ✅ |
| Create | `create_products` | ✅ | ❌ |
| Edit | `edit_products` | ✅ | ✅ |
| Delete | `delete_products` | ✅ | ❌ |
| Navigation | `view_products` | ✅ | ✅ |

**Configuration**:
```php
public static function canAccess(): bool
{
    $user = Auth::user();
    if (!$user instanceof User) return false;
    return $user->hasRole('admin') || $user->hasPermission('view_products');
}

public static function canCreate(): bool
{
    $user = Auth::user();
    if (!$user instanceof User) return false;
    return $user->hasRole('admin') || $user->hasPermission('create_products');
}

public static function canEdit(Model $record): bool
{
    $user = Auth::user();
    if (!$user instanceof User) return false;
    return $user->hasRole('admin') || $user->hasPermission('edit_products');
}

public static function canDelete(Model $record): bool
{
    $user = Auth::user();
    if (!$user instanceof User) return false;
    return $user->hasRole('admin') || $user->hasPermission('delete_products');
}

public static function shouldRegisterNavigation(): bool
{
    return static::canAccess();
}
```

**Filament Pages**:
- `app/Filament/Resources/Products/Pages/ListProducts.php`
- `app/Filament/Resources/Products/Pages/CreateProduct.php`
- `app/Filament/Resources/Products/Pages/EditProduct.php`

---

### RoleResource
**Location**: `app/Filament/Resources/RoleResource.php`

| Operation | Permission Required | Admin | Staff |
|-----------|-------------------|-------|-------|
| Access/View | Admin role only | ✅ | ❌ |
| Create | Admin role only | ✅ | ❌ |
| Edit | Admin role only | ✅ | ❌ |
| Delete | Admin role only | ✅ | ❌ |
| Navigation | Admin role only | ✅ | ❌ |

**Configuration**:
```php
public static function canAccess(): bool
{
    $user = Auth::user();
    if (!$user instanceof User) return false;
    return $user->hasRole('admin');
}

public static function canCreate(): bool
{
    $user = Auth::user();
    if (!$user instanceof User) return false;
    return $user->hasRole('admin');
}

public static function canEdit(Model $record): bool
{
    $user = Auth::user();
    if (!$user instanceof User) return false;
    return $user->hasRole('admin');
}

public static function canDelete(Model $record): bool
{
    $user = Auth::user();
    if (!$user instanceof User) return false;
    return $user->hasRole('admin');
}

public static function shouldRegisterNavigation(): bool
{
    return static::canAccess();
}
```

**Filament Pages**:
- `app/Filament/Resources/Roles/Pages/ListRoles.php`
- `app/Filament/Resources/Roles/Pages/CreateRole.php`
- `app/Filament/Resources/Roles/Pages/EditRole.php`

---

### PermissionResource
**Location**: `app/Filament/Resources/PermissionResource.php`

| Operation | Permission Required | Admin | Staff |
|-----------|-------------------|-------|-------|
| Access/View | Admin role only | ✅ | ❌ |
| Create | Not allowed | ❌ | ❌ |
| Edit | Not allowed | ❌ | ❌ |
| Delete | Not allowed | ❌ | ❌ |
| Navigation | Admin role only | ✅ | ❌ |

**Configuration**:
```php
public static function canAccess(): bool
{
    $user = Auth::user();
    if (!$user instanceof User) return false;
    return $user->hasRole('admin');
}

public static function shouldRegisterNavigation(): bool
{
    return static::canAccess();
}
```

**Filament Pages**:
- `app/Filament/Resources/PermissionResource/Pages/ListPermissions.php`

---

## Permission Requirement Patterns

### Pattern 1: Standard CRUD (Categories, Products, Users)
```php
// Access requires view_*
public static function canAccess(): bool
{
    $user = Auth::user();
    if (!$user instanceof User) return false;
    return $user->hasRole('admin') || $user->hasPermission('view_{resource}');
}

// Create requires create_*
public static function canCreate(): bool
{
    $user = Auth::user();
    if (!$user instanceof User) return false;
    return $user->hasRole('admin') || $user->hasPermission('create_{resource}');
}

// Edit requires edit_*
public static function canEdit(Model $record): bool
{
    $user = Auth::user();
    if (!$user instanceof User) return false;
    return $user->hasRole('admin') || $user->hasPermission('edit_{resource}');
}

// Delete requires delete_*
public static function canDelete(Model $record): bool
{
    $user = Auth::user();
    if (!$user instanceof User) return false;
    return $user->hasRole('admin') || $user->hasPermission('delete_{resource}');
}

// Navigation visibility follows access
public static function shouldRegisterNavigation(): bool
{
    return static::canAccess();
}
```

### Pattern 2: Admin-Only Access (Roles, Permissions)
```php
// Only admin can access
public static function canAccess(): bool
{
    $user = Auth::user();
    if (!$user instanceof User) return false;
    return $user->hasRole('admin');
}

// No other operations needed for read-only
public static function shouldRegisterNavigation(): bool
{
    return static::canAccess();
}
```

### Pattern 3: Dashboard (View-Only)
```php
// Users with view_dashboard permission can access
public static function canAccess(): bool
{
    $user = Auth::user();
    if (!$user instanceof User) return false;
    return $user->hasRole('admin') || $user->hasPermission('view_dashboard');
}

// No create/edit/delete for dashboard widgets
```

---

## Configuration Implementation Details

### Adding Permission Checks to Existing Resource

```php
// Step 1: Import User model and Auth
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

// Step 2: Add canAccess method
public static function canAccess(): bool
{
    $user = Auth::user();
    
    if (!$user instanceof User) {
        return false;
    }
    
    // Admin always has access, or check for specific permission
    return $user->hasRole('admin') || $user->hasPermission('view_resource');
}

// Step 3: Add canCreate method
public static function canCreate(): bool
{
    $user = Auth::user();
    
    if (!$user instanceof User) {
        return false;
    }
    
    return $user->hasRole('admin') || $user->hasPermission('create_resource');
}

// Step 4: Add canEdit method
public static function canEdit(Model $record): bool
{
    $user = Auth::user();
    
    if (!$user instanceof User) {
        return false;
    }
    
    return $user->hasRole('admin') || $user->hasPermission('edit_resource');
}

// Step 5: Add canDelete method
public static function canDelete(Model $record): bool
{
    $user = Auth::user();
    
    if (!$user instanceof User) {
        return false;
    }
    
    return $user->hasRole('admin') || $user->hasPermission('delete_resource');
}

// Step 6: Add shouldRegisterNavigation
public static function shouldRegisterNavigation(): bool
{
    return static::canAccess();
}
```

---

## Dynamic Permission Pattern

For resources that need flexible permission checking:

```php
protected static function getRequiredPermission(string $action): string
{
    return $action . '_' . static::getResourceName();
}

protected static function getResourceName(): string
{
    // Returns 'users' from UserResource
    return strtolower(class_basename(static::class));
}

public static function canAccess(): bool
{
    $user = Auth::user();
    if (!$user instanceof User) return false;
    
    $permission = static::getRequiredPermission('view');
    return $user->hasRole('admin') || $user->hasPermission($permission);
}
```

---

## Testing Permission Checks

### Unit Test Pattern
```php
public function test_staff_can_view_users()
{
    $user = User::factory()->create();
    $user->roles()->attach(Role::where('name', 'staff')->first());
    
    $this->assertTrue($user->hasPermission('view_users'));
}

public function test_staff_cannot_create_users()
{
    $user = User::factory()->create();
    $user->roles()->attach(Role::where('name', 'staff')->first());
    
    $this->assertFalse($user->hasPermission('create_users'));
}

public function test_admin_has_all_permissions()
{
    $user = User::factory()->create();
    $user->roles()->attach(Role::where('name', 'admin')->first());
    
    $this->assertTrue($user->hasPermission('create_users'));
    $this->assertTrue($user->hasPermission('delete_users'));
}
```

---

## Troubleshooting Resource Access

| Issue | Cause | Solution |
|-------|-------|----------|
| Menu item not showing | User lacks view_* permission | Assign role with view_* permission |
| Can't click Create button | User lacks create_* permission | Assign role with create_* permission |
| Can't edit record | User lacks edit_* permission | Assign role with edit_* permission |
| Can't delete record | User lacks delete_* permission | Assign role with delete_* permission |
| All resources hidden | User has no role | Assign role to user |
| Admin can't access | shouldRegisterNavigation returns false | Check canAccess logic |

---

**Documentation Version**: 1.0
**Last Updated**: December 2025
**Maintenance**: Update when adding new resources or permissions
