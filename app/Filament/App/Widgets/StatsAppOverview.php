<?php

namespace App\Filament\App\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
use App\Models\Person;
use App\Models\Baptism;
use App\Models\Communion;
use App\Models\Confirmation;
use App\Models\Marriage;
use App\Models\Ordination;


class StatsAppOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Christians', Person::query()->count())
            ->description('All christians records from the database')
            ->descriptionIcon('heroicon-m-arrow-trending-down')
            ->color('danger'),
            Stat::make('Baptisms', Baptism::query()->count())
            ->description('All baptism records from the database')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success'),
            Stat::make('First Holy Communion', Communion::query()->count())
            ->description('All first holy communion records from the database')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success'),
            Stat::make('Confirmations', Confirmation::query()->count())
            ->description('All confirmation records from the database')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success'),
            Stat::make('Marriages', Marriage::query()->count())
            ->description('All wedding records from the database')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success'),
            Stat::make('Ordinations', Ordination::query()->count())
            ->description('All ordinations records from the database')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success'),
        
        ];
    }
}

