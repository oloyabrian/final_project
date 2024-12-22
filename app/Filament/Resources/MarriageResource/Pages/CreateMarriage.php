<?php

namespace App\Filament\Resources\MarriageResource\Pages;

use App\Filament\Resources\MarriageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateMarriage extends CreateRecord
{
    protected static string $resource = MarriageResource::class;

protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Marriage details created.')
            ->body('The detail is successfully added to the database');
    }
}
