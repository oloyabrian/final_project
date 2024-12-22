<?php

namespace App\Filament\App\Resources\CommunionResource\Pages;

use App\Filament\App\Resources\CommunionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCommunion extends ViewRecord
{
    protected static string $resource = CommunionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
