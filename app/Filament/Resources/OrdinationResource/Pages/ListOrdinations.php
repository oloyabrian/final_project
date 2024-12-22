<?php

namespace App\Filament\Resources\OrdinationResource\Pages;

use App\Filament\Resources\OrdinationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;
use App\Filament\Resources;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Ordination;
use Filament\Pages\Actions\CreateAction;
use Filament\Pages\Actions\Action;

class ListOrdinations extends ListRecords
{
    protected static string $resource = OrdinationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('customButton')
                ->label('Download PDF')
                ->action(fn () => $this->customAction())
                ->url(fn()=>route('download.ordination.pdf'))
                ->openUrlInNewTab(),

            CreateAction::make(),
        ];
    }
    public function getTabs(): array
    {
        return [
            'All'=> Tab::make(),
            'This Week'=> Tab::make()
            ->modifyQueryUsing(fn (Builder $query)=> $query->where('ord_date', '>=', now()->subWeek()))
            ->badge(Ordination::query()->where('ord_date', '>=', now()->subWeek())->count()),
            'This Month'=> Tab::make()
            ->modifyQueryUsing(fn (Builder $query)=> $query->where('ord_date', '>=', now()->subMonth()))
            ->badge(Ordination::query()->where('ord_date', '>=', now()->subMonth())->count()),
            'This Year'=> Tab::make()
            ->modifyQueryUsing(fn (Builder $query)=> $query->where('ord_date', '>=', now()->subYear()))
            ->badge(Ordination::query()->where('ord_date', '>=', now()->subYear())->count()),
        ];
    }
}
