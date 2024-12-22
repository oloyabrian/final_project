<?php
namespace App\Filament\Resources\PersonResource\Pages;

use App\Filament\Resources\PersonResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;
use App\Filament\Resources;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Person;
use Filament\Pages\Actions\CreateAction;
use Filament\Pages\Actions\Action;


class ListPeople extends ListRecords
{
    protected static string $resource = PersonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('customButton')
                ->label('Download PDF')
                ->action(fn () => $this->customAction())
                ->url(fn()=>route('download.person.pdf'))
                ->openUrlInNewTab(),

            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'All'=> Tab::make(),
            'This Week'=> Tab::make()
            ->modifyQueryUsing(fn (Builder $query)=> $query->where('dob','>=', now()->subWeek()))
            ->badge(Person::query()->where('dob','>=', now()->subWeek())->count()),
            'This Month'=> Tab::make()
            ->modifyQueryUsing(fn (Builder $query)=> $query->where('dob','>=', now()->subMonth()))
            ->badge(Person::query()->where('dob','>=', now()->subMonth())->count()),
            'This Year'=> Tab::make()
            ->modifyQueryUsing(fn (Builder $query)=> $query->where('dob','>=', now()->subYear()))
            ->badge(Person::query()->where('dob','>=', now()->subYear())->count()),
        ];
    }
}

