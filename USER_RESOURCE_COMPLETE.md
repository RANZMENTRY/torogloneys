# User Management Resource ✅

## Overview
Resource lengkap untuk mengelola Users dengan role management, mengikuti dokumentasi Filament default.

## Fitur Implementasi

### 1. List View (Table)
**Path**: `/admin/users`

**Kolom yang ditampilkan:**
- **Name** - Nama lengkap user (searchable, sortable)
- **Email** - Email untuk login (searchable, sortable, copyable)
- **Email Verified** - Status verifikasi email (badge icon - success/warning)
- **Roles** - Roles yang dimiliki user (badges dengan info color, multiple)
- **Status** - Aktif atau tidak (icon - success/danger)
- **Created At** - Timestamp pembuatan user (toggleable, hidden by default)

**Fitur Filtering:**
- Filter by Roles (select filter)
- Filter Email Verified (toggle filter)
- Filter Active Users Only (toggle filter)

**Fitur Searching:**
- Search by Name atau Email

**Bulk Actions:**
- Delete multiple users dengan konfirmasi

### 2. Create User Form
**Path**: `/admin/users/create`

**Fields:**
- **Full Name** (TextInput)
  - Required
  - Max 255 characters
  - Placeholder: "Enter full name"

- **Email Address** (TextInput dengan validation email)
  - Required
  - Email validation
  - Unique constraint
  - Placeholder: "user@example.com"

- **Password** (TextInput password)
  - Required (only on create)
  - Min 8 characters
  - Revealable password
  - Dehydrated dengan Hash::make()
  - Placeholder: "Minimum 8 characters"

- **Assign Roles** (CheckboxList)
  - Relationship: belongsToMany with roles
  - Multiple selection
  - 2 columns layout
  - All active roles available

- **Active Account** (Toggle)
  - Default: true
  - Menentukan status user

### 3. Edit User Form
**Path**: `/admin/users/{id}/edit`

**Fields (sama seperti create kecuali):**
- **Password field tidak ditampilkan**
- Form hanya menampilkan:
  - Full Name (editable)
  - Email Address (editable)
  - Assign Roles (editable)
  - Active Account (editable)

**Actions:**
- Delete button di header (dengan konfirmasi)

### 4. User Model Relationships
```php
// Relasi ke Roles
public function roles(): BelongsToMany
{
    return $this->belongsToMany(Role::class, 'model_has_roles', 'model_id', 'role_id')
        ->where('model_has_roles.model_type', User::class);
}

// Relasi ke Permissions
public function permissions(): BelongsToMany
{
    return $this->belongsToMany(Permission::class, 'model_has_permissions', 'model_id', 'permission_id')
        ->where('model_has_permissions.model_type', User::class);
}
```

### 5. Database Schema

**users table:**
```sql
- id (primary)
- name (string, 255)
- email (string, 255, unique)
- email_verified_at (timestamp, nullable)
- password (string)
- active (boolean, default: true) -- NEW FIELD
- remember_token (string, nullable)
- created_at (timestamp)
- updated_at (timestamp)
```

**Relationships tables:**
- `model_has_roles` - Menghubungkan users dengan roles
- `model_has_permissions` - Menghubungkan users dengan permissions
- `role_has_permissions` - Menghubungkan roles dengan permissions

## File Structure

```
app/Filament/Resources/
├── UserResource.php                    # Main resource class
└── Users/
    ├── Schemas/
    │   └── UserForm.php               # Form configuration
    ├── Tables/
    │   └── UsersTable.php             # Table configuration
    └── Pages/
        ├── ListUsers.php              # List page with create button
        ├── CreateUser.php             # Create page
        └── EditUser.php               # Edit page with delete button

app/Models/
└── User.php                           # User model with relationships

database/
└── migrations/
    └── 2025_12_04_000000_add_active_to_users_table.php

database/seeders/
└── UserSeeder.php                     # Seed test users with roles
```

## Validations

✅ **Email:**
- Valid email format
- Unique (ignores current record on update)

✅ **Password:**
- Minimum 8 characters (create only)
- Hashed using Hash::make() before storing

✅ **Name:**
- Required
- Max 255 characters

✅ **Roles:**
- Optional (can assign 0 or multiple roles)
- Only shows active roles

## Features Used from Filament

### Forms
- TextInput with validation (email, minLength)
- Toggle for boolean fields
- CheckboxList for many-to-many relationships
- Conditional visibility based on page type (CreateRecord vs EditRecord)
- Dehydrate for password hashing

### Tables
- TextColumn with search, sort, copy
- IconColumn for boolean display
- BadgeColumn for role display
- Filters: SelectFilter, Filter with toggle
- RecordActions for edit
- BulkActions for delete multiple
- Toggleable columns

### Pages
- ListRecords with CreateAction button
- CreateRecord page
- EditRecord page with DeleteAction button

### Resources
- Standard Filament Resource structure
- Automatic navigation registration
- Model label singular & plural
- Record title attribute for breadcrumbs

## Usage

### Login
```
Email: admin@torogloneys.com
Password: password123
```

### Create New User
1. Navigate to Users menu
2. Click Create button
3. Fill form: Name, Email, Password (min 8 chars), select roles, toggle active
4. Click Create

### Edit User
1. Click user name in table or Edit button
2. Update name, email, roles, or active status
3. Password field tidak tersedia (design: use separate password reset feature)
4. Click Save

### Delete User
1. Open edit form
2. Click Delete button in header
3. Confirm deletion

### Filter Users
- By Role: Select from dropdown
- By Email Verified: Toggle checkbox
- By Active Status: Toggle "Active Users Only"
- Search by Name or Email in search box

## Test Data

Run seeder untuk membuat test user:
```bash
php artisan db:seed --class=UserSeeder
```

Creates:
- User: john@example.com (password: password123)
- Role: admin (assigned to test user)

## Navigation

Users resource muncul di main navigation sidebar dengan icon Users.

## Next Enhancements (Optional)

1. **Password Reset Functionality** - Separate modal/page untuk reset password
2. **Email Verification Toggle** - Toggle untuk manually verify email
3. **Resend Verification Email** - Action untuk resend verification link
4. **User Audit Log** - Track login history dan activity
5. **Two-Factor Authentication** - Setup 2FA untuk users
6. **User Permissions Direct** - Assign permissions directly to users (not just via roles)
7. **Export Users** - CSV/Excel export functionality
8. **Bulk Role Assignment** - Assign roles to multiple users at once

---
**Status**: Ready for Production  
**Created**: 2025-12-04  
**Filament Version**: 4.x  
**Laravel Version**: 12.41.1
