<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class UserAdminChart extends ChartWidget
{
    protected static ?string $heading = 'User Chart';
    protected static string $color = 'success';
    protected static ?int $sort = 7;

    protected function getData(): array
    {
        $data = $this->getUserTrendData();

        return [
            'datasets' => [
                [
                    'label' => 'Users',
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

    private function getUserTrendData(): Collection
    {
        $startOfYear = now()->startOfYear();
        $endOfYear = now()->endOfYear();

        $months = collect(range(1, 12))->map(function ($month) use ($startOfYear) {
            return $startOfYear->clone()->month($month)->startOfMonth();
        });

        $userCounts = $months->map(function (Carbon $month) {
            return [
                'date' => $month,
                'aggregate' => User::whereYear('created_at', $month->year)
                                    ->whereMonth('created_at', $month->month)
                                    ->count(),
            ];
        });

        return $userCounts;
    }
}
