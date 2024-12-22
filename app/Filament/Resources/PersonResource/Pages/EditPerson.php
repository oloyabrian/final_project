<?php

namespace App\Filament\Resources\PersonResource\Pages;

use App\Filament\Resources\PersonResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditPerson extends EditRecord
{
    protected static string $resource = PersonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
    protected function getSavedNotification(): Notification
    {
        return Notification::make()
                ->success()
                ->title('Person details saved.')
                ->body('The detail is successfully saved to the database');
    }
}
