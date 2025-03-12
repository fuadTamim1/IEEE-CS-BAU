<?php

namespace App\Filament\Resources\BlogResource\Widgets;

use App\Models\Blog;
use App\Models\Category;
use Filament\Widgets\ChartWidget;

class BlogPostCategoryChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';
    protected static string $color = 'info';
    protected function getData(): array
    {
        // Fetch all categories with their blog counts
        $categories = Category::withCount('blogs')->get();

        // Prepare data for the chart
        $labels = $categories->pluck('title');
        $data = $categories->pluck('blogs_count');
        // Define a base set of colors
        $baseColors = [
            '#FF6384', // Red
            '#36A2EB', // Blue
            '#FFCE56', // Yellow
            '#4BC0C0', // Teal
            '#9966FF', // Purple
            '#FF9F40', // Orange
        ];

        // Dynamically assign colors based on the number of categories
        $colors = [];
        for ($i = 0; $i < $categories->count(); $i++) {
            $colors[] = $baseColors[$i % count($baseColors)]; // Cycle through the base colors
        }

        return [
            'datasets' => [
                [
                    'label' => 'Blog Posts',
                    'data' => $data,
                    'backgroundColor' => $colors
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
