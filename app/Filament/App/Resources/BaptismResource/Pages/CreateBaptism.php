<?php

namespace App\Filament\App\Resources\BaptismResource\Pages;

use App\Filament\App\Resources\BaptismResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateBaptism extends CreateRecord
{
    protected static string $resource = BaptismResource::class;

protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Baptism details created.')
            ->body('The detail is successfully added to the database');
    }
}