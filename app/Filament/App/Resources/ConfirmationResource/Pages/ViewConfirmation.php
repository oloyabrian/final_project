<?php

namespace App\Filament\App\Resources\ConfirmationResource\Pages;

use App\Filament\App\Resources\ConfirmationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewConfirmation extends ViewRecord
{
    protected static string $resource = ConfirmationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
