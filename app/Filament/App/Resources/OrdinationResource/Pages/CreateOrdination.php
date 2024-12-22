<?php

namespace App\Filament\App\Resources\OrdinationResource\Pages;

use App\Filament\App\Resources\OrdinationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateOrdination extends CreateRecord
{
    protected static string $resource = OrdinationResource::class;

protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Ordination details created.')
            ->body('The detail is successfully added to the database');
    }
}