# Navigation Groups Configuration Reference

## 🎯 Quick Reference

### Navigation Group Structure

```
Dashboard (Standalone - Sort: -1)
│
├─ Master Data (Group - Sort: 0)
│  ├─ Categories (Sort: 0)
│  └─ Products (Sort: 1)
│
└─ User Management (Group - Sort: 100)
   ├─ Users (Sort: 100)
   ├─ Roles (Sort: 101)
   └─ Permissions (Sort: 102)
```

---

## 📋 Resources Configuration

### CategoryResource
**File:** `app/Filament/Resources/Categories/CategoryResource.php`
```php
protected static ?string $navigationGroup = 'Master Data';
protected static ?int $navigationSort = 0;
```

### ProductResource
**File:** `app/Filament/Resources/Products/ProductResource.php`
```php
protected static ?string $navigationGroup = 'Master Data';
protected static ?int $navigationSort = 1;
```

### UserResource
**File:** `app/Filament/Resources/UserResource.php`
```php
protected static ?string $navigationGroup = 'User Management';
protected static ?int $navigationSort = 100;
```

### RoleResource
**File:** `app/Filament/Resources/RoleResource.php`
```php
protected static ?string $navigationGroup = 'User Management';
protected static ?int $navigationSort = 101;
```

### PermissionResource
**File:** `app/Filament/Resources/PermissionResource.php`
```php
protected static ?string $navigationGroup = 'User Management';
protected static ?int $navigationSort = 102;
```

---

## ⚙️ AdminPanelProvider Configuration

**File:** `app/Providers/Filament/AdminPanelProvider.php`

```php
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
```

---

## 📊 Permission Matrix by Role

| Resource | Admin | Staff | User |
|----------|-------|-------|------|
| Categories | CRUD | Read/Update | Read |
| Products | CRUD | Read/Update | Read |
| Users | CRUD | Read | - |
| Roles | CRUD | - | - |
| Permissions | Read | - | - |

---

## 🔄 How Navigation Access Works

1. **User navigates to admin panel**
   ↓
2. **Filament calls `canAccess()` on each Resource**
   ↓
3. **If `canAccess()` returns false, item is hidden**
   ↓
4. **If all items in group are hidden, group is hidden**
   ↓
5. **Final navigation is rendered with only accessible items**

---

## 🎨 Available Icons

### Group Icons
```
Master Data      → heroicon-o-archive-box
User Management  → heroicon-o-users
Settings         → heroicon-o-cog-6-tooth
Reports          → heroicon-o-chart-bar
Security         → heroicon-o-lock-closed
Help             → heroicon-o-question-mark-circle
```

### Resource Icons (Current)
```
Categories       → Heroicon::OutlinedRectangleStack
Products         → Heroicon::OutlinedCube
Users            → Heroicon::OutlinedUsers
Roles            → Heroicon::OutlinedKey
Permissions      → Heroicon::OutlinedLockOpen
Dashboard        → (Standalone, no group)
```

---

## ✅ Testing Navigation

### Manual Testing Checklist

- [ ] Login as Admin
  - [ ] All Master Data items visible
  - [ ] All User Management items visible
  - [ ] Group icons display correctly
  - [ ] Can collapse/expand groups
  
- [ ] Login as Staff
  - [ ] Master Data group visible
  - [ ] Categories and Products visible
  - [ ] User Management group visible
  - [ ] Users visible, Roles/Permissions hidden
  
- [ ] Login as User
  - [ ] Master Data group visible
  - [ ] Categories and Products visible (read-only)
  - [ ] User Management group hidden
  
- [ ] Test Group Collapsibility
  - [ ] Click group icon to expand
  - [ ] Click group icon to collapse
  - [ ] State persists on page refresh

---

## 🔧 Adding New Resource to Group

### Step 1: Create Resource
```bash
php artisan make:filament-resource ProductCategoryResource \
    --create --edit --view
```

### Step 2: Add to Group
```php
class ProductCategoryResource extends Resource
{
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?int $navigationSort = 2; // After Products
}
```

### Step 3: Implement canAccess()
```php
public static function canAccess(): bool
{
    $user = Auth::user();
    
    if (!$user instanceof User) {
        return false;
    }
    
    if ($user->hasRole('admin')) {
        return true;
    }
    
    return $user->hasPermission('view_product_categories');
}
```

### Step 4: No AdminPanelProvider Changes Needed
The new resource automatically joins the group!

---

## 🐛 Common Issues & Solutions

### Issue: Item not showing in group
**Solution:** Check that `$navigationGroup` name exactly matches

### Issue: Group not showing at all
**Solution:** Verify at least one item in group is accessible

### Issue: Wrong sort order
**Solution:** Ensure `$navigationSort` values don't conflict

### Issue: Icon not displaying
**Solution:** Verify icon name is correct (use `heroicon-o-` format)

---

## 📝 Trait Reference

**File:** `app/Filament/Resources/Traits/NavigationGrouping.php`

Provides constants for:
- `NAVIGATION_GROUP_MASTER_DATA`
- `NAVIGATION_GROUP_USER_MANAGEMENT`
- `SORT_CATEGORIES`
- `SORT_PRODUCTS`
- `SORT_USERS`
- `SORT_ROLES`
- `SORT_PERMISSIONS`

---

## 🚀 Performance Notes

- Navigation groups are cached
- Permission checking happens per-user
- No database queries for navigation setup
- Groups collapse/expand client-side (no reload)

---

**Last Updated:** December 6, 2025
**Filament Version:** 3.x
**Status:** Production Ready
