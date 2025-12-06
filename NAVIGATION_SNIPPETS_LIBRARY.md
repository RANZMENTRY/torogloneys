# Navigation Groups - Code Snippets Library

## 📚 Copy-Paste Ready Code Snippets

---

## 1. AdminPanelProvider Configuration

### Basic Setup (Current)
```php
// File: app/Providers/Filament/AdminPanelProvider.php

use Filament\Navigation\NavigationGroup;

public function panel(Panel $panel): Panel
{
    return $panel
        ->default()
        ->id('admin')
        ->path('admin')
        // ... other configuration ...
        ->navigationGroups([
            // Master Data Group
            NavigationGroup::make('Master Data')
                ->icon('heroicon-o-archive-box')
                ->collapsed(false),
            
            // User Management Group
            NavigationGroup::make('User Management')
                ->icon('heroicon-o-users')
                ->collapsed(false),
        ])
        // ... rest of configuration ...
        ;
}
```

### Advanced Setup with Descriptions
```php
NavigationGroup::make('Master Data')
    ->icon('heroicon-o-archive-box')
    ->collapsed(false)
    ->extraSidebarAttributes([
        'class' => 'bg-amber-50 dark:bg-amber-950/20',
    ]),
```

### Setup with Default Collapsed
```php
NavigationGroup::make('Settings')
    ->icon('heroicon-o-cog-6-tooth')
    ->collapsed(true), // Default: collapsed
```

---

## 2. Resource Configuration Snippets

### Master Data Group - Categories
```php
// File: app/Filament/Resources/Categories/CategoryResource.php

class CategoryResource extends Resource
{
    use NavigationGrouping;

    protected static ?string $model = Category::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Categories';
    
    // Navigation Group Configuration
    protected static ?string $navigationGroup = 'Master Data';
    
    protected static ?int $navigationSort = 0;

    // ... rest of code ...
}
```

### Master Data Group - Products
```php
// File: app/Filament/Resources/Products/ProductResource.php

class ProductResource extends Resource
{
    use NavigationGrouping;

    protected static ?string $model = Product::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCube;

    protected static ?string $navigationLabel = 'Products';
    
    // Navigation Group Configuration
    protected static ?string $navigationGroup = 'Master Data';
    
    protected static ?int $navigationSort = 1;

    // ... rest of code ...
}
```

### User Management Group - Users
```php
// File: app/Filament/Resources/UserResource.php

class UserResource extends Resource
{
    use NavigationGrouping;

    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    protected static ?string $navigationLabel = 'Users';
    
    // Navigation Group Configuration
    protected static ?string $navigationGroup = 'User Management';
    
    protected static ?int $navigationSort = 100;

    // ... rest of code ...
}
```

### User Management Group - Roles
```php
// File: app/Filament/Resources/RoleResource.php

class RoleResource extends Resource
{
    use NavigationGrouping;

    protected static ?string $model = Role::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedKey;

    protected static ?string $navigationLabel = 'Roles';
    
    // Navigation Group Configuration
    protected static ?string $navigationGroup = 'User Management';
    
    protected static ?int $navigationSort = 101;

    // ... rest of code ...
}
```

### User Management Group - Permissions
```php
// File: app/Filament/Resources/PermissionResource.php

class PermissionResource extends Resource
{
    use NavigationGrouping;

    protected static ?string $model = Permission::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedLockOpen;

    protected static ?string $navigationLabel = 'Permissions';
    
    // Navigation Group Configuration
    protected static ?string $navigationGroup = 'User Management';
    
    protected static ?int $navigationSort = 102;

    // ... rest of code ...
}
```

---

## 3. Permission Checking Snippets

### Basic Permission Check
```php
public static function canAccess(): bool
{
    $user = Auth::user();
    
    if (!$user instanceof User) {
        return false;
    }
    
    // Admin always has access
    if ($user->hasRole('admin')) {
        return true;
    }
    
    // Check for specific permission
    return $user->hasPermission('view_categories');
}
```

### Role-Based Access
```php
public static function canAccess(): bool
{
    $user = Auth::user();
    
    if (!$user instanceof User) {
        return false;
    }
    
    // Allow admin and staff
    return $user->hasRole(['admin', 'staff']);
}
```

### Complex Permission Logic
```php
public static function canAccess(): bool
{
    $user = Auth::user();
    
    if (!$user instanceof User) {
        return false;
    }
    
    // Admin has full access
    if ($user->hasRole('admin')) {
        return true;
    }
    
    // Staff can only view and edit
    if ($user->hasRole('staff')) {
        return $user->hasAnyPermission(['view_products', 'edit_products']);
    }
    
    // Users can only view
    return $user->hasPermission('view_products');
}
```

---

## 4. Create Action Snippets

### Create Permission with specific module
```php
Permission::create([
    'name' => 'view_categories',
    'module' => 'Master Data',
    'description' => 'View categories list',
]);
```

### Assign permission to role
```php
$adminRole = Role::where('name', 'admin')->first();
$adminRole->givePermissionTo('view_categories');
```

### Check permission in Blade
```blade
@can('view_categories')
    <!-- Show content -->
@endcan
```

---

## 5. Navigation Trait Snippet

### NavigationGrouping Trait
```php
// File: app/Filament/Resources/Traits/NavigationGrouping.php

<?php

namespace App\Filament\Resources\Traits;

trait NavigationGrouping
{
    /**
     * Navigation Group Constants
     */
    public const NAVIGATION_GROUP_MASTER_DATA = 'Master Data';
    public const NAVIGATION_GROUP_USER_MANAGEMENT = 'User Management';

    /**
     * Navigation Sort Order
     */
    public const SORT_DASHBOARD = -1;
    
    // Master Data Group (sort order 0, items inside: 0-99)
    public const SORT_MASTER_DATA_GROUP = 0;
    public const SORT_CATEGORIES = 0;
    public const SORT_PRODUCTS = 1;
    
    // User Management Group (sort order 100, items inside: 100-199)
    public const SORT_USER_MANAGEMENT_GROUP = 100;
    public const SORT_USERS = 100;
    public const SORT_ROLES = 101;
    public const SORT_PERMISSIONS = 102;
}
```

---

## 6. Adding New Navigation Group

### Step 1: Update AdminPanelProvider
```php
->navigationGroups([
    NavigationGroup::make('Master Data')
        ->icon('heroicon-o-archive-box')
        ->collapsed(false),
    
    NavigationGroup::make('User Management')
        ->icon('heroicon-o-users')
        ->collapsed(false),
    
    // New Group
    NavigationGroup::make('Reports')
        ->icon('heroicon-o-chart-bar')
        ->collapsed(true),
])
```

### Step 2: Create Resource with Group
```php
class ReportResource extends Resource
{
    protected static ?string $navigationGroup = 'Reports';
    protected static ?int $navigationSort = 200;
    
    // ... rest of code ...
}
```

---

## 7. Icon Reference Snippets

### Using String Icons
```php
NavigationGroup::make('Master Data')
    ->icon('heroicon-o-archive-box')
```

### Using Icon Class
```php
use Filament\Support\Icons\Heroicon;

class CategoryResource extends Resource
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
}
```

---

## 8. Testing Snippets

### Tinker Commands
```php
# Check if user is admin
Auth::user()->hasRole('admin')

# Check if user has permission
Auth::user()->hasPermission('view_categories')

# Get user roles
Auth::user()->roles

# Get user permissions
Auth::user()->permissions

# Check resource access
App\Filament\Resources\CategoryResource::canAccess()
```

### Test with Different Roles
```php
# Switch to admin
Auth::login(User::whereHas('roles', fn ($q) => $q->where('name', 'admin'))->first())

# Switch to staff
Auth::login(User::whereHas('roles', fn ($q) => $q->where('name', 'staff'))->first())

# Switch to user
Auth::login(User::whereHas('roles', fn ($q) => $q->where('name', 'user'))->first())
```

---

## 9. Debugging Snippets

### Debug canAccess
```php
dd(
    'User ID' => Auth::id(),
    'User Role' => Auth::user()->roles->pluck('name'),
    'User Permissions' => Auth::user()->permissions->pluck('name'),
    'Can Access Category' => CategoryResource::canAccess(),
);
```

### Debug Navigation
```php
// In tinker
$resource = CategoryResource::class;
dd([
    'label' => $resource::getNavigationLabel(),
    'group' => $resource::$navigationGroup,
    'sort' => $resource::$navigationSort,
    'access' => $resource::canAccess(),
]);
```

---

## 10. Custom Navigation Group with Advanced Options

```php
NavigationGroup::make('Settings')
    ->label(fn (): string => __('navigation.settings'))
    ->icon('heroicon-o-cog-6-tooth')
    ->collapsed(true)
    ->extraSidebarAttributes([
        'class' => 'bg-gray-50 dark:bg-gray-900',
    ])
    ->extraTopbarAttributes([
        'class' => 'px-2 py-1',
    ])
```

---

## 📋 Common Patterns

### Pattern 1: Grouping by Feature
```php
// All payment-related resources in one group
->navigationGroups([
    NavigationGroup::make('Payments')
        ->icon('heroicon-o-credit-card'),
    NavigationGroup::make('Users')
        ->icon('heroicon-o-users'),
])
```

### Pattern 2: Grouping by Access Level
```php
// Different groups for different audiences
->navigationGroups([
    NavigationGroup::make('Public'),
    NavigationGroup::make('Staff Management'),
    NavigationGroup::make('System'),
])
```

### Pattern 3: Using Sort Numbers Consistently
```php
// 0-99: First group
// 100-199: Second group
// 200-299: Third group

SORT_PUBLIC_GROUP = 0
SORT_PUBLIC_ITEM1 = 0
SORT_PUBLIC_ITEM2 = 1

SORT_STAFF_GROUP = 100
SORT_STAFF_ITEM1 = 100
```

---

**Version:** 1.0
**Last Updated:** December 6, 2025
**Ready to Use:** ✅ Yes
