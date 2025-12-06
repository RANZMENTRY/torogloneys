<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\OrderItem;
use Filament\Widgets\ChartWidget;
use Filament\Support\RawJs;

class OrdersByCategoryChart extends ChartWidget
{
    protected ?string $heading = 'Orders by Category';
    protected ?string $description = 'Number of orders per product category';
    protected ?string $maxHeight = '300px';

    protected function getData(): array
    {
        // Get all categories with order count
        $categories = Category::withCount(['orderItems'])->get();
        
        // Colors for each category
        $colors = [
            '#3b82f6', // Blue
            '#ef4444', // Red
            '#10b981', // Green
            '#f59e0b', // Amber
            '#8b5cf6', // Purple
            '#ec4899', // Pink
            '#06b6d4', // Cyan
            '#f97316', // Orange
            '#14b8a6', // Teal
            '#6366f1', // Indigo
        ];

        $data = [];
        $labels = [];
        $backgroundColors = [];
        $borderColors = [];

        foreach ($categories as $index => $category) {
            $labels[] = $category->name;
            $data[] = $category->order_items_count;
            
            // Get color from array, loop if necessary
            $colorIndex = $index % count($colors);
            $backgroundColors[] = $colors[$colorIndex];
            $borderColors[] = $colors[$colorIndex];
        }

        return [
            'datasets' => [
                [
                    'label' => 'Total Orders',
                    'data' => $data,
                    'backgroundColor' => $backgroundColors,
                    'borderColor' => $borderColors,
                    'borderWidth' => 2,
                    'borderRadius' => 5,
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
                            stepSize: 1,
                        },
                    },
                },
                plugins: {
                    legend: {
                        display: false,
                    },
                },
            }
        JS);
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
