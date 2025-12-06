# 🧪 Testing Dashboard - Panduan Menambah Data

Panduan ini membantu Anda membuat data dummy untuk testing dashboard.

## Metode 1: Menggunakan Tinker (Rekomendasi)

### 1. Buka Tinker Terminal
```bash
php artisan tinker
```

### 2. Buat Customers
```php
// Buat 25 customers
$customers = \App\Models\Customer::factory(25)->create();
```

### 3. Buat Categories
```php
// Buat 5 kategori
\App\Models\Category::create(['name' => 'Elektronik']);
\App\Models\Category::create(['name' => 'Fashion']);
\App\Models\Category::create(['name' => 'Makanan']);
\App\Models\Category::create(['name' => 'Buku']);
\App\Models\Category::create(['name' => 'Peralatan']);
```

### 4. Buat Orders
```php
// Buat 142 orders dengan status bervariasi
for ($i = 0; $i < 142; $i++) {
    $status = collect(['pending', 'completed', 'cancelled'])->random();
    $totalAmount = rand(50000, 5000000);
    
    \App\Models\Order::create([
        'customer_id' => \App\Models\Customer::inRandomOrder()->first()->id,
        'total_amount' => $totalAmount,
        'status' => $status,
        'created_at' => now()->subMonths(rand(0, 11))->subDays(rand(0, 30)),
    ]);
}
```

### 5. Buat OrderItems
```php
// Untuk setiap order, buat 1-3 order items
$orders = \App\Models\Order::all();
foreach ($orders as $order) {
    $itemCount = rand(1, 3);
    for ($i = 0; $i < $itemCount; $i++) {
        \App\Models\OrderItem::create([
            'order_id' => $order->id,
            'category_id' => \App\Models\Category::inRandomOrder()->first()->id,
            'quantity' => rand(1, 10),
            'price' => rand(10000, 1000000),
        ]);
    }
}
```

### 6. Verifikasi Data
```php
// Keluar dari tinker dengan: exit()
// Lalu refresh dashboard di browser
```

---

## Metode 2: Menggunakan Database Seeder

### 1. Edit DatabaseSeeder.php
```bash
# File: database/seeders/DatabaseSeeder.php
```

Tambahkan kode berikut:

```php
<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Customer;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create users for authentication
        User::factory(3)->create();

        // Create categories
        $categories = collect([
            ['name' => 'Elektronik'],
            ['name' => 'Fashion'],
            ['name' => 'Makanan'],
            ['name' => 'Buku'],
            ['name' => 'Peralatan'],
        ]);
        
        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create customers
        Customer::factory(25)->create();

        // Create orders with items
        $statuses = ['pending', 'completed', 'cancelled'];
        
        for ($i = 0; $i < 142; $i++) {
            $order = Order::create([
                'customer_id' => Customer::inRandomOrder()->first()->id,
                'total_amount' => rand(50000, 5000000),
                'status' => $statuses[array_rand($statuses)],
                'created_at' => now()->subMonths(rand(0, 11))->subDays(rand(0, 30)),
            ]);

            // Create order items for each order
            for ($j = 0; $j < rand(1, 3); $j++) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'category_id' => Category::inRandomOrder()->first()->id,
                    'quantity' => rand(1, 10),
                    'price' => rand(10000, 1000000),
                ]);
            }
        }
    }
}
```

### 2. Jalankan Seeder
```bash
# Bersihkan database dan jalankan seeder
php artisan migrate:fresh --seed

# Atau hanya jalankan seeder
php artisan db:seed
```

---

## Metode 3: Menggunakan Factory

### 1. Buat/Edit Factory

#### CustomerFactory
```php
# File: database/factories/CustomerFactory.php
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
        ];
    }
}
```

#### OrderFactory
```php
# File: database/factories/OrderFactory.php
<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'total_amount' => fake()->numberBetween(50000, 5000000),
            'status' => fake()->randomElement(['pending', 'completed', 'cancelled']),
            'created_at' => fake()->dateTimeBetween('-12 months', 'now'),
        ];
    }
}
```

#### OrderItemFactory
```php
# File: database/factories/OrderItemFactory.php
<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(),
            'quantity' => fake()->numberBetween(1, 10),
            'price' => fake()->numberBetween(10000, 1000000),
        ];
    }
}
```

### 2. Jalankan Factory dari Tinker
```bash
php artisan tinker
```

```php
// Buat data menggunakan factory
Customer::factory(25)->create();
Order::factory(142)->create();

// For each order, create 1-3 items
Order::all()->each(function($order) {
    OrderItem::factory(rand(1, 3))->create(['order_id' => $order->id]);
});

exit()
```

---

## 📊 Data yang Diharapkan

Setelah menjalankan seeder/tinker, dashboard harus menampilkan:

### Stats Widget
- **Total Orders**: 142
- **Pending Orders**: ~47 (kurang lebih 1/3 dari 142)
- **Total Revenue**: Rp 1-2 Milyar (tergantung random amount)
- **Total Customers**: 25

### Revenue Per Month Chart
- Data untuk 12 bulan terakhir
- Setiap bulan memiliki revenue dari order completed

### Orders by Category Chart
- 5 bar chart untuk 5 kategori
- Tinggi bar berbeda sesuai jumlah order

---

## 🔄 Reset Data

Jika ingin menghapus semua data dan mulai dari awal:

```bash
# Opsi 1: Reset dengan seed otomatis
php artisan migrate:fresh --seed

# Opsi 2: Reset tanpa seed (manual)
php artisan migrate:fresh

# Opsi 3: Hanya truncate (hapus data, tapi struktur tetap)
php artisan tinker
DB::statement('SET FOREIGN_KEY_CHECKS=0');
DB::table('orders')->truncate();
DB::table('order_items')->truncate();
DB::table('customers')->truncate();
DB::table('categories')->truncate();
DB::statement('SET FOREIGN_KEY_CHECKS=1');
exit()
```

---

## ✅ Checklist Sebelum Testing

- [ ] Database sudah di-migrate
- [ ] Model sudah dibuat (Order, Customer, Category, OrderItem)
- [ ] Migration sudah dibuat dengan kolom yang benar
- [ ] Relasi di model sudah dikonfigurasi
- [ ] Factory sudah dibuat (opsional)
- [ ] Seeder sudah dijalankan atau data ditambah via tinker
- [ ] Dashboard page dan widgets sudah dibuat
- [ ] PanelProvider sudah dikonfigurasi
- [ ] Sudah login ke admin panel
- [ ] Dashboard menampilkan data dengan benar

---

## 🧩 Struktur Data yang Dibutuhkan

### Categories Table
```
id | name | created_at | updated_at
1  | Elektronik | ... | ...
2  | Fashion | ... | ...
3  | Makanan | ... | ...
4  | Buku | ... | ...
5  | Peralatan | ... | ...
```

### Customers Table
```
id | name | email | phone | address | created_at | updated_at
1  | John Doe | john@example.com | ... | ... | ... | ...
...
25 | Jane Smith | jane@example.com | ... | ... | ... | ...
```

### Orders Table
```
id | customer_id | total_amount | status | created_at | updated_at
1  | 5 | 1500000 | completed | 2024-11-15 | ...
2  | 3 | 750000 | pending | 2024-11-20 | ...
...
142 | 12 | 2000000 | completed | 2024-06-10 | ...
```

### Order Items Table
```
id | order_id | category_id | quantity | price | created_at | updated_at
1  | 1 | 2 | 5 | 300000 | ... | ...
2  | 1 | 1 | 2 | 100000 | ... | ...
3  | 2 | 3 | 10 | 75000 | ... | ...
...
```

---

Selamat testing! 🚀
