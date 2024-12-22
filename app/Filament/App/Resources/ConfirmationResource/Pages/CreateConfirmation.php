<?php

namespace App\Filament\App\Resources\ConfirmationResource\Pages;

use App\Filament\App\Resources\ConfirmationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateConfirmation extends CreateRecord
{
    protected static string $resource = ConfirmationResource::class;

protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Confirmation details created.')
            ->body('The detail is successfully added to the database');
    }
}