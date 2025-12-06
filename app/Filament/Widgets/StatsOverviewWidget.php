<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Customer;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Support\Enums\IconPosition;

class StatsOverviewWidget extends BaseWidget
{
    protected ?string $heading = 'Dashboard Overview';
    protected ?string $description = 'Key metrics for your business';

    protected function getStats(): array
    {
        // Calculate total orders
        $totalOrders = Order::count();
        
        // Calculate pending orders
        $pendingOrders = Order::where('status', 'pending')->count();
        
        // Calculate total revenue in Rupiah
        $totalRevenue = Order::where('status', '!=', 'pending')
            ->sum('total_amount');
        
        // Calculate total customers
        $totalCustomers = Customer::count();

        return [
            Stat::make('Total Orders', $totalOrders)
                ->description('Total pesanan sepanjang waktu')
                ->descriptionIcon('heroicon-m-shopping-bag', IconPosition::Before)
                ->color('info'),
            
            Stat::make('Pending Orders', $pendingOrders)
                ->description('Pesanan yang menunggu proses')
                ->descriptionIcon('heroicon-m-clock', IconPosition::Before)
                ->color('warning'),
            
            Stat::make('Total Revenue', 'Rp ' . number_format($totalRevenue, 0, ',', '.'))
                ->description('Total pendapatan')
                ->descriptionIcon('heroicon-m-currency-dollar', IconPosition::Before)
                ->color('success'),
            
            Stat::make('Total Customers', $totalCustomers)
                ->description('Jumlah pelanggan terdaftar')
                ->descriptionIcon('heroicon-m-users', IconPosition::Before)
                ->color('primary'),
        ];
    }
}
