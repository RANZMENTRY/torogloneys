<?php

use App\Models\User;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Create admin user
$user = User::create([
    'name' => 'Admin',
    'email' => 'admin@torogloneys.com',
    'password' => bcrypt('password123'),
]);

echo "✅ Admin user created:\n";
echo "Email: {$user->email}\n";
echo "Password: password123\n";
