<?php

namespace App\Filament\App\Resources\ConfirmationResource\Pages;

use App\Filament\App\Resources\ConfirmationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditConfirmation extends EditRecord
{
    protected static string $resource = ConfirmationResource::class;

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
                ->title('Confirmation details saved.')
                ->body('The detail is successfully saved to the database');
    }
}

