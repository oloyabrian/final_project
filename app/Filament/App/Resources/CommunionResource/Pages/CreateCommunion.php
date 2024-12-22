<?php

namespace App\Filament\App\Resources\CommunionResource\Pages;

use App\Filament\App\Resources\CommunionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateCommunion extends CreateRecord
{
    protected static string $resource = CommunionResource::class;

protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Communion details created.')
            ->body('The detail is successfully added to the database');
    }
}