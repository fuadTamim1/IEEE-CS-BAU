<?php

namespace App\Filament\Widgets;

use App\Models\Bcpc\BcpcRegistration;
use Filament\Widgets\ChartWidget;

class ContestTeamSizeChart extends ChartWidget
{
    protected static ?string $heading = 'BCPC Team Size Split';

    protected function getData(): array
    {
        $counts = BcpcRegistration::query()
            ->selectRaw('COALESCE(team_size, 0) as team_size, COUNT(*) as aggregate')
            ->groupBy('team_size')
            ->pluck('aggregate', 'team_size');

        $labels = ['Teams of 2', 'Teams of 3'];
        $data = [
            (int) ($counts[2] ?? 0),
            (int) ($counts[3] ?? 0),
        ];

        if ((int) ($counts[0] ?? 0) > 0) {
            $labels[] = 'Unspecified';
            $data[] = (int) $counts[0];
        }

        return [
            'datasets' => [
                [
                    'label' => 'Registrations',
                    'data' => $data,
                    'backgroundColor' => ['#f59e0b', '#fb7185', '#94a3b8'],
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
