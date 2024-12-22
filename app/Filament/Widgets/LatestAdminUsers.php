<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\User;
use Filament\Tables\Columns\TextColumn;


class LatestAdminUsers extends BaseWidget
{
    protected static ?int $sort = 8;
    protected int | string| array $columnSpan= 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(User::query())
            ->defaultSort('created_at', 'DESC')
            ->columns([
                TextColumn::make('name')->label('User Name') ->searchable(),
                TextColumn::make('email')->label('User Email'),
                TextColumn::make('role')->label('User Role'),
            ]);
    }
}
