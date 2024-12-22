<?php

namespace App\Filament\Widgets;


use Filament\Widgets\ChartWidget;
use App\Models\Confirmation;
use Flowframe\Trend\Trend;
use Flowframe\Trend\Trendvalue;
use Illuminate\Support\Collection;

class ConfirmationAdminChart extends ChartWidget
{
    protected static ?string $heading = 'Confirmations Chart';
    protected static string $color = 'info';
    protected static ?int $sort = 4;

    protected function getData(): array
    {
        $data = Trend::model(Confirmation::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();
     
        return [
            'datasets' => [
                [
                    'label' => 'Confirmation',
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
