<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\Trendvalue;
use App\Models\Person; 
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class PersonAdminChart extends ChartWidget
{
    protected static ?string $heading = 'Persons Chart';
    protected static string $color = 'success';
    protected static ?int $sort = 1;

    protected function getData(): array
    {
        $data = $this->getPersonTrendData();

        return [
            'datasets' => [
                [
                    'label' => 'Persons',
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

    private function getPersonTrendData(): Collection
    {
        $startOfYear = now()->startOfYear();
        $endOfYear = now()->endOfYear();

        $months = collect(range(1, 12))->map(function ($month) use ($startOfYear) {
            return $startOfYear->clone()->month($month)->startOfMonth();
        });

        $personCounts = $months->map(function (Carbon $month) {
            return [
                'date' => $month,
                'aggregate' => Person::whereYear('created_at', $month->year)
                                    ->whereMonth('created_at', $month->month)
                                    ->count(),
            ];
        });

        return $personCounts;
    }
}
