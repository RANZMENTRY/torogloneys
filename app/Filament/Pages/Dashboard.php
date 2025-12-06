<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\StatsOverviewWidget;
use App\Filament\Widgets\RevenuePerMonthChart;
use App\Filament\Widgets\OrdersByCategoryChart;
use App\Models\User;
use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Support\Facades\Auth;

class Dashboard extends BaseDashboard
{
    /**
     * Get the title of the dashboard page with role
     */
    public function getTitle(): string
    {
        $user = Auth::user();
        $roleName = 'User';
        
        if ($user instanceof User) {
            $role = $user->roles()->first();
            if ($role) {
                $roleName = ucfirst($role->name);
            }
        }
        
        return 'Dashboard ' . $roleName . ' – E-Commerce';
    }

    /**
     * Get the heading subtitle based on user role
     */
    public function getHeading(): string
    {
        $user = Auth::user();
        $roleName = 'user';
        
        if ($user instanceof User) {
            $role = $user->roles()->first();
            if ($role) {
                $roleName = $role->name;
            }
        }
        
        return match($roleName) {
            'admin' => 'Selamat Datang di Dashboard Admin E-Commerce',
            'staff' => 'Selamat Datang di Dashboard Staff',
            'user' => 'Selamat Datang di Dashboard Anda',
            default => 'Selamat Datang di Dashboard'
        };
    }

    /**
     * Get the subheading with role-specific description
     */
    public function getSubheading(): ?string
    {
        $user = Auth::user();
        $roleName = 'user';
        
        if ($user instanceof User) {
            $role = $user->roles()->first();
            if ($role) {
                $roleName = $role->name;
            }
        }
        
        return match($roleName) {
            'admin' => 'Anda memiliki full system access. Kelola produk, pesanan, pengguna, laporan penjualan, promosi, serta seluruh konfigurasi platform untuk memastikan bisnis berjalan lancar dan efisien.',
            'staff' => 'Anda memiliki akses terbatas (view & edit only). Pantau dan kelola pesanan, update stok produk, serta dukung aktivitas operasional harian guna memastikan pengalaman pelanggan tetap optimal.',
            'user' => 'Anda memiliki akses view only. Lihat status pesanan, riwayat transaksi, metode pembayaran, dan pengaturan akun untuk memudahkan pengalaman belanja Anda.',
            default => 'Dashboard E-Commerce'
        };
    }

    /**
     * Get all widgets for the dashboard
     * 
     * @return array<string | int>
     */
    public function getWidgets(): array
    {
        return [
            StatsOverviewWidget::class,
            RevenuePerMonthChart::class,
            OrdersByCategoryChart::class,
        ];
    }

    /**
     * Configure the grid columns for dashboard layout
     * 
     * Using 2 columns for better layout
     * - Stats widget: Full width (spans 2 columns)
     * - Revenue chart: Half width (1 column)
     * - Category chart: Half width (1 column)
     */
    public function getColumns(): int | array
    {
        return 2;
    }
}
