<?php

namespace App\Filament\Resources\MarriageResource\Pages;

use App\Filament\Resources\MarriageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;
use App\Filament\Resources;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Marriage;
use Filament\Pages\Actions\CreateAction;
use Filament\Pages\Actions\Action;

class ListMarriages extends ListRecords
{
    protected static string $resource = MarriageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('downloadMarriagePDF')
                ->label('Download PDF')
                ->url(fn() => route('download.marriage.pdf'))
                ->openUrlInNewTab(),

            CreateAction::make(),
        ];
    }
    public function getTabs(): array
    {
        return [
            'All'=> Tab::make(),
            'This Week'=> Tab::make()
            ->modifyQueryUsing(fn (Builder $query)=>$query->where('marriage_date', '>=', now()->subWeek()))
            ->badge(Marriage::query()->where('marriage_date', '>=', now()->subWeek())->count()),
            'This Month'=> Tab::make()
            ->modifyQueryUsing(fn (Builder $query)=>$query->where('marriage_date', '>=', now()->subMonth()))
            ->badge(Marriage::query()->where('marriage_date', '>=', now()->subMonth())->count()),
            'This Year'=> Tab::make()
            ->modifyQueryUsing(fn (Builder $query)=>$query->where('marriage_date', '>=', now()->subYear()))
            ->badge(Marriage::query()->where('marriage_date', '>=', now()->subYear())->count()),
        ];
    }
}
