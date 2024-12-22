<?php

namespace App\Filament\Resources\BaptismResource\Pages;

use App\Filament\Resources\BaptismResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;
use App\Filament\Resources;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Baptism;
use Filament\Pages\Actions\CreateAction;
use Filament\Pages\Actions\Action;


class ListBaptisms extends ListRecords
{
    protected static string $resource = BaptismResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('downloadBaptismPDF')
                ->label('Download PDF')
                ->url(fn() => route('download.baptism.pdf'))
                ->openUrlInNewTab(),

            CreateAction::make(),
        ];
    }
    public function getTabs():array
    {
        return [
            'All'=> Tab::make(),
            'This Week'=> Tab::make()
            ->modifyQueryUsing( fn (Builder $query)=>$query->where('bdate', '>=', now()->subWeek()))
            ->badge(Baptism::query()->where('bdate', '>=', now()->subWeek())->count()),
            'This Month'=> Tab::make()
            ->modifyQueryUsing( fn (Builder $query)=>$query->where('bdate', '>=', now()->subMonth()))
            ->badge(Baptism::query()->where('bdate', '>=', now()->subMonth())->count()),
            'This Year'=> Tab::make()
            ->modifyQueryUsing( fn (Builder $query)=>$query->where('bdate', '>=', now()->subYear()))
            ->badge(Baptism::query()->where('bdate', '>=', now()->subYear())->count()),
        ];
    }
}
