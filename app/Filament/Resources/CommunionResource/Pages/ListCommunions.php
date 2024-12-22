<?php

namespace App\Filament\Resources\CommunionResource\Pages;

use App\Filament\Resources\CommunionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;
use App\Filament\Resources;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Communion;
use Filament\Pages\Actions\CreateAction;
use Filament\Pages\Actions\Action;

class ListCommunions extends ListRecords
{
    protected static string $resource = CommunionResource::class;

    protected function getHeaderActions(): array
    {
        return [
           
            Action::make('downloadCommunionPDF')
                ->label('Download PDF')
                ->url(fn() => route('download.communion.pdf'))
                ->openUrlInNewTab(),

            CreateAction::make(),
      
    ];
    }
    public function getTabs(): array
    {
        return [
            'All'=> Tab::make(),
            'This Week'=> Tab::make()
            ->modifyQueryUsing(fn (Builder $query)=>$query->where('cdate', '>=', now()->subWeek()))
            ->badge(Communion::query()->where('cdate', '>=', now()->subWeek())->count()),
            'This Month'=> Tab::make()
            ->modifyQueryUsing(fn (Builder $query)=>$query->where('cdate', '>=', now()->subMonth()))
            ->badge(Communion::query()->where('cdate', '>=', now()->subMonth())->count()),
            'This Year'=> Tab::make()
            ->modifyQueryUsing(fn (Builder $query)=>$query->where('cdate', '>=', now()->subYear()))
            ->badge(Communion::query()->where('cdate', '>=', now()->subYear())->count()),
        ];
    }
}
