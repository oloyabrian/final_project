<?php

namespace App\Filament\Widgets;


use Filament\Widgets\ChartWidget;
use App\Models\Ordination;
use Flowframe\Trend\Trend;
use Flowframe\Trend\Trendvalue;
use Illuminate\Support\Collection;

class OrdinationAdminChart extends ChartWidget
{
    protected static ?string $heading = 'Ordinations Chart';
    protected static string $color = 'info';
    protected static ?int $sort = 6;

    protected function getData(): array
    {
        $data = Trend::model(Ordination::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();
     
        return [
            'datasets' => [
                [
                    'label' => 'Ordination',
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
