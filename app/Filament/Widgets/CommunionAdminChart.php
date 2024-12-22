<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Communion;
use Flowframe\Trend\Trend;
use Flowframe\Trend\Trendvalue;
use Illuminate\Support\Collection;

class CommunionAdminChart extends ChartWidget
{
    protected static ?string $heading = 'First Holy Communions Chart';
    protected static ?int $sort = 3;
    protected function getData(): array
    {
        $data = Trend::model(Communion::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();
     
        return [
            'datasets' => [
                [
                    'label' => 'Communion',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
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
}
