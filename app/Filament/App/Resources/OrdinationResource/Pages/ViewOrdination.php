<?php

namespace App\Filament\App\Resources\OrdinationResource\Pages;

use App\Filament\App\Resources\OrdinationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewOrdination extends ViewRecord
{
    protected static string $resource = OrdinationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
