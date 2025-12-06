# ⚡ QUICK START - Dashboard Filament

## 🚀 3 Langkah untuk Mulai

### Step 1: Akses Dashboard
```
1. Buka browser
2. Ketik: http://localhost/admin
3. Login dengan akun admin
```

### Step 2: Lihat Dashboard
```
Dashboard akan langsung tampil dengan:
✓ 4 widget statistik (stats cards)
✓ 1 line chart (revenue)
✓ 1 bar chart (category)
```

### Step 3: (Optional) Tambah Data
```bash
php artisan tinker

# Buat 25 customers
\App\Models\Customer::factory(25)->create();

# Buat 5 categories
\App\Models\Category::create(['name' => 'Elektronik']);
\App\Models\Category::create(['name' => 'Fashion']);
\App\Models\Category::create(['name' => 'Makanan']);
\App\Models\Category::create(['name' => 'Buku']);
\App\Models\Category::create(['name' => 'Peralatan']);

# Buat 142 orders dengan order items
for ($i = 0; $i < 142; $i++) {
    $order = \App\Models\Order::create([
        'customer_id' => \App\Models\Customer::inRandomOrder()->first()->id,
        'total_amount' => rand(50000, 5000000),
        'status' => collect(['pending', 'completed', 'cancelled'])->random(),
        'created_at' => now()->subMonths(rand(0, 11))->subDays(rand(0, 30)),
    ]);
    
    for ($j = 0; $j < rand(1, 3); $j++) {
        \App\Models\OrderItem::create([
            'order_id' => $order->id,
            'category_id' => \App\Models\Category::inRandomOrder()->first()->id,
            'quantity' => rand(1, 10),
            'price' => rand(10000, 1000000),
        ]);
    }
}

exit()
```

---

## 📂 File-File Penting

```
✅ Dashboard Page: app/Filament/Pages/Dashboard.php
✅ Stats Widget: app/Filament/Widgets/StatsOverviewWidget.php
✅ Revenue Chart: app/Filament/Widgets/RevenuePerMonthChart.php
✅ Category Chart: app/Filament/Widgets/OrdersByCategoryChart.php
✅ Config: app/Providers/Filament/AdminPanelProvider.php
```

---

## 🔍 File Location

Jika tidak tahu file mana yang baru, ini lokasinya:

```
c:\laragon\www\torogloneys\
├── app\
│   ├── Filament\
│   │   ├── Pages\
│   │   │   └── Dashboard.php ← BARU
│   │   └── Widgets\
│   │       ├── StatsOverviewWidget.php ← BARU
│   │       ├── RevenuePerMonthChart.php ← BARU
│   │       └── OrdersByCategoryChart.php ← BARU
│   └── Providers\
│       └── Filament\
│           └── AdminPanelProvider.php ← MODIFIED
```

---

## 📊 Yang Ditampilkan Dashboard

### Stats Overview Widget
- **Total Orders**: Jumlah semua order
- **Pending Orders**: Order dengan status pending
- **Total Revenue**: Sum dari order yang completed (format Rupiah)
- **Total Customers**: Jumlah semua customer

### Revenue Per Month Chart
- Trend revenue 12 bulan terakhir
- Tema warna hijau
- Format Rupiah

### Orders by Category Chart
- Jumlah order per kategori
- Warna berbeda untuk setiap kategori

---

## 🎨 Customization

### Ubah Warna Stats Widget
Edit `app/Filament/Widgets/StatsOverviewWidget.php`:

```php
->color('warning')  // Dari 'info' jadi 'warning'
```

### Ubah Warna Revenue Chart
Edit `app/Filament/Widgets/RevenuePerMonthChart.php`:

```php
'borderColor' => '#FF0000', // Ubah ke merah
'backgroundColor' => 'rgba(255, 0, 0, 0.1)',
```

### Ubah Time Range
Edit `app/Filament/Widgets/RevenuePerMonthChart.php`:

```php
for ($i = 5; $i >= 0; $i--) {  // Ubah dari 12 ke 6 bulan
```

---

## 🐛 Troubleshooting

### Dashboard Tidak Muncul
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

### Widget Tidak Ada Data
```bash
php artisan tinker
Order::count()  # Harus > 0
Customer::count()  # Harus > 0
Category::count()  # Harus > 0
exit()
```

### Chart Tidak Tampil
1. Open browser console (F12)
2. Check untuk error messages
3. Refresh page
4. Clear cache

---

## 📚 Dokumentasi Lengkap

Untuk detail lebih lanjut, buka:

- 📖 **DASHBOARD_DOCUMENTATION.md** - Dokumentasi lengkap
- 🧪 **TESTING_GUIDE.md** - Panduan testing & menambah data
- 📋 **DASHBOARD_IMPLEMENTATION.md** - Ringkasan implementasi
- ✅ **IMPLEMENTATION_CHECKLIST.md** - Checklist verifikasi
- 🏗️ **DASHBOARD_ARCHITECTURE.md** - Arsitektur & diagram

---

## ⚙️ Sistem Requirements

- PHP 8.1+
- Laravel 11+
- Filament 4.x
- MySQL/MariaDB
- Composer

---

## 💡 Tips

✅ Gunakan Tinker untuk test query  
✅ Clear cache jika ada perubahan  
✅ Refresh browser setelah edit file  
✅ Check Laravel logs untuk error  
✅ Use browser DevTools untuk debug  

---

## 📞 Help

Jika ada yang tidak jelas:

1. Buka file dokumentasi di project
2. Cek https://filamentphp.com/docs
3. Search error di browser console
4. Test di tinker

---

**Dashboard Anda siap! Mulai dari akses `/admin` 🚀**
