<?php

namespace App\Filament\App\Resources\BaptismResource\Pages;

use App\Filament\App\Resources\BaptismResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditBaptism extends EditRecord
{
    protected static string $resource = BaptismResource::class;

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
                ->title('Baptism details saved.')
                ->body('The detail is successfully saved to the database');
    }
}

