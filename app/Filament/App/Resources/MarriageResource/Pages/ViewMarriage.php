<?php

namespace App\Filament\App\Resources\MarriageResource\Pages;

use App\Filament\App\Resources\MarriageResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMarriage extends ViewRecord
{
    protected static string $resource = MarriageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
