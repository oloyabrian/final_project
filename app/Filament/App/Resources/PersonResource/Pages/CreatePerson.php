<?php

namespace App\Filament\App\Resources\PersonResource\Pages;

use App\Filament\App\Resources\PersonResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreatePerson extends CreateRecord
{
    protected static string $resource = PersonResource::class;

   protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Person details created.')
            ->body('The detail is successfully added to the database');
    }
}
