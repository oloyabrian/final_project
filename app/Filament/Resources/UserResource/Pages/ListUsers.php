<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Pages\Actions\CreateAction;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ListRecords\Tab;
use App\Filament\Resources;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('customButton')
                ->label('Download PDF')
                ->action(fn () => $this->customAction())
                ->url(fn()=>route('download.user.pdf'))
                ->openUrlInNewTab(),

            CreateAction::make(),
        ];
    }
}
