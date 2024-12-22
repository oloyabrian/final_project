<?php

namespace App\Filament\App\Resources\ConfirmationResource\Pages;

use App\Filament\App\Resources\ConfirmationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Pages\Actions\CreateAction;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ListRecords\Tab;
use App\Filament\Resources;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Confirmation;


class ListConfirmations extends ListRecords
{
    protected static string $resource = ConfirmationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('downloadConfirmationPDF')
                ->label('Download PDF')
                ->url(fn() => route('download.confirmation.pdf'))
                ->openUrlInNewTab(),

            CreateAction::make(),
        ];
    }
    public function getTabs(): array
    {
        return [
            'All'=> Tab::make(),
            'This Week'=> Tab::make()
            ->modifyQueryUsing(fn (Builder $query)=>$query->where('confirmdate', '>=', now()->subWeek()))
            ->badge(Confirmation::query()->where('confirmdate', '>=', now()->subWeek())->count()),
            'This Month'=> Tab::make()
            ->modifyQueryUsing(fn (Builder $query)=>$query->where('confirmdate', '>=', now()->subMonth()))
            ->badge(Confirmation::query()->where('confirmdate', '>=', now()->subMonth())->count()),
            'This Year'=> Tab::make()
            ->modifyQueryUsing(fn (Builder $query)=>$query->where('confirmdate', '>=', now()->subYear()))
            ->badge(Confirmation::query()->where('confirmdate', '>=', now()->subYear())->count()),
        ];
    }
}
