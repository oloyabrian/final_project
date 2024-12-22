<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Baptism; // Make sure to import the Baptism model
use Carbon\Carbon;
use Illuminate\Support\Collection;

class BaptismAdminChart extends ChartWidget
{
    protected static ?string $heading = 'Baptisms Chart';
    protected static string $color = 'info';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $data = $this->getBaptismTrendData();

        return [
            'datasets' => [
                [
                    'label' => 'Baptisms',
                    'data' => $data->pluck('aggregate'),
                    'backgroundColor' => $this->getColor(),
                ],
            ],
            'labels' => $data->pluck('date')->map(fn (Carbon $date) => $date->format('F')),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    public function getColor(): string
    {
        return self::$color;
    }

    private function getBaptismTrendData(): Collection
    {
        $startOfYear = now()->startOfYear();
        $endOfYear = now()->endOfYear();

        $months = collect(range(1, 12))->map(function ($month) use ($startOfYear) {
            return $startOfYear->clone()->month($month)->startOfMonth();
        });

        $baptismCounts = $months->map(function (Carbon $month) {
            return [
                'date' => $month,
                'aggregate' => Baptism::whereYear('created_at', $month->year)
                                     ->whereMonth('created_at', $month->month)
                                     ->count(),
            ];
        });

        return $baptismCounts;
    }
}
