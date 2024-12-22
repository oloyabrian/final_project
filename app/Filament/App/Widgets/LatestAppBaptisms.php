<?php

namespace App\Filament\App\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Baptism;
use Filament\Tables\Columns\TextColumn;

class LatestAppBaptisms extends BaseWidget
{
    protected int | string| array $columnSpan= 'full';
    protected static ?int $sort = 2;
    public function table(Table $table): Table
    {
        return $table
            ->query(Baptism::query())
            ->defaultSort('created_at', 'DESC')
            ->columns([
                TextColumn::make('person.cname')->label('Christian Name') ->searchable(),
                TextColumn::make('person.sname')->label('Surname') ->searchable(),
                TextColumn::make('place')->label('Place') ->searchable(),
                TextColumn::make('sponsor')->label('Sponsor') ->searchable(),
                TextColumn::make('minister')->label('Minister') ->searchable(),
            ]);
    }
}
