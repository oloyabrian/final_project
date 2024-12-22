<?php

namespace App\Filament\App\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Person;
use Filament\Tables\Columns\TextColumn;

class LatestAppPersons extends BaseWidget
{
    protected int | string| array $columnSpan= 'full';
    protected static ?int $sort = 1;
    public function table(Table $table): Table
    {
        return $table
            ->query(Person::query())
            ->defaultSort('created_at', 'DESC')
            ->columns([
                TextColumn::make('cname')->label('Christian Name') ->searchable(),
                TextColumn::make('sname')->label('Surname') ->searchable(),
                TextColumn::make('gender')->label('Gender') ->searchable(),
                TextColumn::make('village')->label('Village') ->searchable(),
                TextColumn::make('email')->label('Email'),
            ]);
    }
}
