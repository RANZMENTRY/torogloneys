# Panduan Lengkap: Mengorganisir Navigation Groups di Filament

## 📋 Daftar Isi
1. [Pengenalan](#pengenalan)
2. [Struktur Navigation yang Diimplementasikan](#struktur-navigation-yang-diimplementasikan)
3. [Cara Kerja](#cara-kerja)
4. [Implementasi](#implementasi)
5. [Role-Based Navigation Access](#role-based-navigation-access)
6. [Best Practices](#best-practices)
7. [Troubleshooting](#troubleshooting)

---

## 🎯 Pengenalan

Navigation Groups memungkinkan Anda mengorganisir item-item di sidebar menjadi kategori yang terstruktur. Ini sangat berguna ketika aplikasi Anda memiliki banyak resource dan Anda ingin membuat navigasi lebih rapi dan mudah dipahami.

### Keuntungan Navigation Groups:
- ✅ Navigasi lebih terorganisir
- ✅ User experience lebih baik
- ✅ Mudah menemukan fitur yang dicari
- ✅ Bisa di-collapse untuk menghemat space
- ✅ Bisa dikonfigurasi dengan icon
- ✅ Automatic permission checking

---

## 📐 Struktur Navigation yang Diimplementasikan

Berikut adalah struktur navigation yang telah dikonfigurasi di project Anda:

```
Dashboard (Standalone)
│
├─ Master Data (Group) 📦
│  ├─ Categories
│  └─ Products
│
└─ User Management (Group) 👥
   ├─ Users
   ├─ Roles
   └─ Permissions
```

### Penjelasan Setiap Group:

#### **Master Data Group**
- **Icon**: `heroicon-o-archive-box` (📦)
- **Items**: Categories, Products
- **Purpose**: Mengelola data produk dan kategori
- **Collapsible**: Ya (bisa dibuka/tutup)

#### **User Management Group**
- **Icon**: `heroicon-o-users` (👥)
- **Items**: Users, Roles, Permissions
- **Purpose**: Mengelola user, role, dan permission
- **Collapsible**: Ya (bisa dibuka/tutup)

---

## ⚙️ Cara Kerja

### 1. **Konfigurasi di AdminPanelProvider**

File: `app/Providers/Filament/AdminPanelProvider.php`

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

**Penjelasan:**
- `make('Label')` → Label yang ditampilkan di sidebar
- `->icon()` → Icon dari Blade Icons (Hero Icons)
- `->collapsed()` → `false` = expanded by default, `true` = collapsed by default

### 2. **Konfigurasi di Resource Class**

File: Setiap Resource (Categories, Products, Users, etc.)

```php
protected static ?string $navigationGroup = 'Master Data';
protected static ?int $navigationSort = 0;
```

**Penjelasan:**
- `$navigationGroup` → Nama group yang sesuai dengan yang di AdminPanelProvider
- `$navigationSort` → Urutan item dalam group (semakin kecil semakin atas)

### 3. **Permission Checking**

Navigation items otomatis tersembunyi jika user tidak memiliki akses melalui method `canAccess()`:

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
    
    // Check for permission
    return $user->hasPermission('view_categories');
}
```

---

## 🔧 Implementasi

### File yang Sudah Diupdate:

#### 1. **Trait untuk Constants** (Opsional)
File: `app/Filament/Resources/Traits/NavigationGrouping.php`

Ini berisi konstanta untuk naming convention dan sorting order:
```php
// Navigation Group Constants
public const NAVIGATION_GROUP_MASTER_DATA = 'Master Data';
public const NAVIGATION_GROUP_USER_MANAGEMENT = 'User Management';

// Sort Order Constants
public const SORT_CATEGORIES = 0;
public const SORT_PRODUCTS = 1;
public const SORT_USERS = 100;
public const SORT_ROLES = 101;
public const SORT_PERMISSIONS = 102;
```

#### 2. **CategoryResource**
```php
class CategoryResource extends Resource
{
    use NavigationGrouping;

    protected static ?string $navigationGroup = 'Master Data';
    protected static ?int $navigationSort = 0;
    
    // ... rest of code
}
```

#### 3. **ProductResource**
```php
class ProductResource extends Resource
{
    use NavigationGrouping;

    protected static ?string $navigationGroup = 'Master Data';
    protected static ?int $navigationSort = 1;
    
    // ... rest of code
}
```

#### 4. **UserResource**
```php
class UserResource extends Resource
{
    use NavigationGrouping;

    protected static ?string $navigationGroup = 'User Management';
    protected static ?int $navigationSort = 100;
    
    // ... rest of code
}
```

#### 5. **RoleResource**
```php
class RoleResource extends Resource
{
    use NavigationGrouping;

    protected static ?string $navigationGroup = 'User Management';
    protected static ?int $navigationSort = 101;
    
    // ... rest of code
}
```

#### 6. **PermissionResource**
```php
class PermissionResource extends Resource
{
    use NavigationGrouping;

    protected static ?string $navigationGroup = 'User Management';
    protected static ?int $navigationSort = 102;
    
    // ... rest of code
}
```

#### 7. **AdminPanelProvider**
File: `app/Providers/Filament/AdminPanelProvider.php`

Sudah dikonfigurasi dengan `navigationGroups()` method.

---

## 👥 Role-Based Navigation Access

Setiap role memiliki akses yang berbeda:

### **Admin Role**
- Melihat semua navigation items
- Master Data Group
  - Categories (CRUD)
  - Products (CRUD)
- User Management Group
  - Users (CRUD)
  - Roles (CRUD)
  - Permissions (Read only)

### **Staff Role**
- Master Data Group
  - Categories (Read & Update)
  - Products (Read & Update)
- User Management Group
  - Users (Read only)

### **User Role**
- Master Data Group
  - Categories (Read only)
  - Products (Read only)

**Cara Kerja:**
1. Filament automatically calls `canAccess()` sebelum menampilkan navigation item
2. Jika `canAccess()` return `false`, item tidak ditampilkan
3. Jika semua items dalam group tidak bisa diakses, group juga tidak ditampilkan

---

## 📚 Best Practices

### 1. **Naming Convention**

**Untuk Group Names:**
- Gunakan PascalCase dengan spasi: `Master Data`, `User Management`
- Buat descriptive dan jelas
- Jangan terlalu panjang (maksimal 2-3 kata)

**Contoh Baik:**
```
✅ Master Data
✅ User Management
✅ System Settings
✅ Reports & Analytics
```

**Contoh Buruk:**
```
❌ Data
❌ Manage
❌ PM (terlalu singkat)
```

### 2. **Icon Selection**

Gunakan icon dari Blade Icons (Hero Icons). Format: `heroicon-o-icon-name`

**Tips:**
- Gunakan outline icon (`heroicon-o-`) untuk konsistensi
- Pilih icon yang representative untuk group
- Test visual appearance di sidebar

**Contoh Icon yang Tepat:**
```php
'Master Data' → 'heroicon-o-archive-box' (📦)
'User Management' → 'heroicon-o-users' (👥)
'Settings' → 'heroicon-o-cog-6-tooth' (⚙️)
'Reports' → 'heroicon-o-chart-bar' (📊)
'Security' → 'heroicon-o-lock-closed' (🔒)
```

### 3. **Sort Order**

Gunakan sistem numbering yang konsisten:

```php
// Group-level sorting (0-based, ascending)
Master Data Group = 0
User Management Group = 100

// Item-level sorting within group
Categories = 0
Products = 1

Users = 100 (atau 0 jika dalam group yang berbeda)
Roles = 101
Permissions = 102
```

**Keuntungan numbering ini:**
- Mudah menambah item baru di tengah-tengah
- Tidak perlu re-sort semua items
- Jelas hierarchy-nya

### 4. **Collapsed State**

```php
// Default expanded (user melihat items)
->collapsed(false)

// Default collapsed (user perlu click untuk expand)
->collapsed(true)
```

**Kapan collapsed?**
- Collapsed jika group memiliki 5+ items
- Expanded jika group memiliki <5 items
- Expand jika group adalah prioritas utama

### 5. **Permission Checking**

Selalu implement `canAccess()` yang robust:

```php
public static function canAccess(): bool
{
    $user = Auth::user();
    
    if (!$user instanceof User) {
        return false;
    }
    
    // Quick exit untuk admin
    if ($user->hasRole('admin')) {
        return true;
    }
    
    // Check specific permission
    return $user->hasPermission('view_categories');
}
```

### 6. **Group Icon vs Item Icon**

```php
// Group dengan icon, items tanpa icon
NavigationGroup::make('Master Data')
    ->icon('heroicon-o-archive-box')

// Di Resource:
protected static ?string $navigationIcon = null; // ❌ Jangan set icon
```

**Kenapa?** Untuk visual hierarchy yang jelas di sidebar.

---

## 🐛 Troubleshooting

### Problem 1: **Navigation Items Tidak Muncul**

**Kemungkinan Penyebab:**
1. `canAccess()` return `false`
2. `shouldRegisterNavigation()` return `false`
3. `$navigationGroup` tidak sesuai dengan yang di AdminPanelProvider

**Solusi:**
```php
// Debug: Cek di tinker
php artisan tinker
> Auth::user()->hasRole('admin')
> Auth::user()->hasPermission('view_categories')
> CategoryResource::canAccess()

// Atau lihat di Network tab (inspect element)
```

### Problem 2: **Navigation Group Tidak Muncul**

**Kemungkinan Penyebab:**
1. Semua items dalam group tidak bisa diakses
2. Typo di group name (`'Master Data'` vs `'master data'`)

**Solusi:**
```php
// Di AdminPanelProvider, pastikan spelling match dengan Resource
NavigationGroup::make('Master Data') // ✅ Match
protected static ?string $navigationGroup = 'Master Data'; // ✅ Match
```

### Problem 3: **Icon Tidak Muncul**

**Kemungkinan Penyebab:**
1. Icon name typo
2. Icon tidak exist di Blade Icons

**Solusi:**
```php
// Cek daftar icon di: https://blade-ui-kit.com/blade-icons?set=1
// Format: heroicon-o-ICON_NAME (outline)
// atau   heroicon-s-ICON_NAME (solid)

// Test icon di console:
<i class="heroicon-o-archive-box"></i>
```

### Problem 4: **Urutan Items Tidak Benar**

**Kemungkinan Penyebab:**
1. `$navigationSort` value overlapping
2. Alphabetical sorting masih aktif

**Solusi:**
```php
// Pastikan $navigationSort unique per group
Master Data Group:
  Categories = 0
  Products = 1

User Management Group:
  Users = 100
  Roles = 101
  Permissions = 102
```

### Problem 5: **Permission Not Respecting Role**

**Kemungkinan Penyebab:**
1. User tidak memiliki permission yang diwajibkan
2. Permission belum di-seed ke database

**Solusi:**
```php
// Jalankan seeder
php artisan db:seed --class=PermissionSeeder
php artisan db:seed --class=RoleSeeder

// Debug: Cek permissions di database
SELECT * FROM permissions WHERE name LIKE '%categories%';
```

---

## 📞 Menambah Navigation Group Baru

Jika Anda ingin menambah group baru, ikuti langkah ini:

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
    NavigationGroup::make('Reporting')
        ->icon('heroicon-o-chart-bar')
        ->collapsed(true), // Collapsed by default
])
```

### Step 2: Update Resource
```php
class ReportResource extends Resource
{
    protected static ?string $navigationGroup = 'Reporting';
    protected static ?int $navigationSort = 200; // Besar dari group sebelumnya
    
    // ... rest of code
}
```

### Step 3: Test
- Login sebagai different roles
- Verify group muncul dengan items yang benar
- Check icon tampil dengan baik

---

## 📖 Referensi Lengkap

- **Filament Docs**: https://filamentphp.com/docs/3.x/panels/navigation
- **Blade Icons**: https://blade-ui-kit.com/blade-icons?set=1
- **Your Project Permissions**: `database/seeders/PermissionSeeder.php`
- **Your Project RBAC**: `README_RBAC.md` atau `RBAC_SUMMARY.md`

---

## ✅ Checklist Implementasi

- [x] Update AdminPanelProvider dengan navigationGroups()
- [x] Add `$navigationGroup` ke CategoryResource
- [x] Add `$navigationGroup` ke ProductResource
- [x] Add `$navigationGroup` ke UserResource
- [x] Add `$navigationGroup` ke RoleResource
- [x] Add `$navigationGroup` ke PermissionResource
- [x] Set `$navigationSort` untuk semua resources
- [x] Test permission checking di setiap role
- [x] Verify icons muncul dengan benar
- [ ] Deploy ke production
- [ ] Monitor user feedback
- [ ] Optimize jika diperlukan

---

**Dibuat:** December 6, 2025
**Status:** ✅ Implementation Complete
