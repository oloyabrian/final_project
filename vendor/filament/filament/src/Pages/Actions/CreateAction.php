<?php

namespace Filament\Pages\Actions;

use Filament\Actions\CreateAction as BaseAction;
use Filament\Pages\Actions\CreateAction;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\ButtonAction;



/**
 * @deprecated Use `\Filament\Actions\CreateAction` instead.
 */
class CreateAction extends BaseAction
{
    public static function getDefaultName($title = null): ?string
{
    return '$title';
}
}
