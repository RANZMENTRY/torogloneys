<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Filament\Support\RawJs;
use Carbon\Carbon;

class RevenuePerMonthChart extends ChartWidget
{
    protected ?string $heading = 'Revenue Per Month';
    protected ?string $description = 'Revenue trend for the last 12 months';
    protected ?string $maxHeight = '300px';
    protected string $color = 'success';

    protected function getData(): array
    {
        // Get last 12 months data
        $data = [];
        $labels = [];
        
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $startDate = $date->clone()->startOfMonth();
            $endDate = $date->clone()->endOfMonth();
            
            // Calculate revenue for the month (only completed orders)
            $revenue = Order::whereBetween('created_at', [$startDate, $endDate])
                ->where('status', '!=', 'pending')
                ->sum('total_amount');
            
            $data[] = $revenue;
            $labels[] = $date->format('M Y'); // Format: Jan 2024
        }

        return [
            'datasets' => [
                [
                    'label' => 'Revenue (Rupiah)',
                    'data' => $data,
                    'borderColor' => '#10b981', // Green color
                    'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                    'tension' => 0.4,
                    'fill' => true,
                    'borderWidth' => 2,
                    'pointRadius' => 5,
                    'pointBackgroundColor' => '#10b981',
                    'pointBorderColor' => '#fff',
                    'pointBorderWidth' => 2,
                    'pointHoverRadius' => 7,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getOptions(): RawJs
    {
        return RawJs::make(<<<JS
            {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: (value) => 'Rp' + new Intl.NumberFormat('id-ID').format(value),
                        },
                    },
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                },
            }
        JS);
    }

    protected function getType(): string
    {
        return 'line';
    }
}
