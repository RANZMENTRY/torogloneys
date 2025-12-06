<?php

use App\Models\User;
use App\Models\Customer;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "🔄 Creating test data...\n";

// Create categories
$categories = [
    'Elektronik',
    'Fashion',
    'Makanan',
    'Buku',
    'Peralatan'
];

foreach ($categories as $cat) {
    Category::create(['name' => $cat]);
}
echo "✅ Created 5 categories\n";

// Create customers
Customer::factory(25)->create();
echo "✅ Created 25 customers\n";

// Create orders with order items
for ($i = 0; $i < 142; $i++) {
    $statuses = ['pending', 'completed', 'cancelled'];
    $status = $statuses[array_rand($statuses)];
    
    $order = Order::create([
        'customer_id' => Customer::inRandomOrder()->first()->id,
        'total_amount' => rand(50000, 5000000),
        'status' => $status,
        'created_at' => now()->subMonths(rand(0, 11))->subDays(rand(0, 30)),
    ]);
    
    // Create order items
    for ($j = 0; $j < rand(1, 3); $j++) {
        OrderItem::create([
            'order_id' => $order->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'quantity' => rand(1, 10),
            'price' => rand(10000, 1000000),
        ]);
    }
}
echo "✅ Created 142 orders with order items\n";

echo "\n🎉 Test data created successfully!\n";
echo "\n📊 Dashboard Statistics:\n";
echo "   • Total Orders: " . Order::count() . "\n";
echo "   • Pending Orders: " . Order::where('status', 'pending')->count() . "\n";
echo "   • Total Revenue: Rp " . number_format(Order::where('status', '!=', 'pending')->sum('total_amount'), 0, ',', '.') . "\n";
echo "   • Total Customers: " . Customer::count() . "\n";
echo "   • Total Categories: " . Category::count() . "\n";
