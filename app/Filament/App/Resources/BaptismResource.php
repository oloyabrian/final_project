<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\BaptismResource\Pages;
use App\Filament\App\Resources\BaptismResource\RelationManagers;
use App\Models\Baptism;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;

class BaptismResource extends Resource
{
    protected static ?string $model = Baptism::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';
    protected static ?string $navigationGroup = 'Sacrament Management';
    protected static ?string $navigationLabel = 'Baptisms';
    protected static ?string $modelLabel = 'Baptisms';

    protected static ?int $navigationSort = 2;
    protected static ?string $recordTitleAttribute = 'place';
    public static function getGlobalSearchResultTitle (Model $record): string
    {
        return $record->sponsor;
    }
    public static function getGloballySearchableAttributes(): array
    {
        return ['person.sname',
        'person.cname',
        'minister',
        'place',
        'person.address',
        'person.village',
        'sponsor'];
    }
    public static function getGlobalSearchQuery(): Builder
    {
        return static::getModel()::query()
            ->where(function (Builder $query) {
                $query->whereHas('person', function (Builder $query) {
                    $search = request()->input('search');
                    $query->whereFullName($search)
                          ->orWhere('sname', 'like', "%{$search}%")
                          ->orWhere('cname', 'like', "%{$search}%");
                })
                ->orWhere('place', 'like', "%{$search}%")
                ->orWhere('sponsor', 'like', "%{$search}%")
                ->orWhere('minister', 'like', "%{$search}%");
            });
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'success';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('person_id')
               ->relationship(name: 'person', titleAttribute: 'cname')
               ->native(false)
               ->label('Person ID')
               ->preload()
               ->searchable()
                ->label('Person ID')
                ->required(),
                Forms\Components\DatePicker::make('bdate')
                ->label('Date Baptised')
                ->displayFormat('d/m/Y')
                ->native(false)
                    ->required(),
                Forms\Components\TextInput::make('place')
                ->label('Baptism Place')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('sponsor')
                ->label('Sponsor')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('minister')
                ->label('Minister')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\Select::make('person_id')
                    ->relationship(name: 'person', titleAttribute: 'cname')
                ->native(false)
                    ->label('Person Name')
                    ->preload()
               ->searchable()
                    ->required(),
            ]); 
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('person.full_name')  // Use the accessor
                    ->label('Full Name')
                    ->searchable(['sname', 'cname'], function (Builder $query, string $search): Builder {
                        return $query->whereHas('person', function (Builder $query) use ($search) {
                            return $query->whereFullName($search);
                        });
                    }),
                Tables\Columns\TextColumn::make('bdate')
                    ->date()
                    ->label('Date')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('place')
                ->label('Place')
                ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('sponsor')
                ->label('Sponsor')
                ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('minister')
                ->label('Minister')
                ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                ->label('Updated At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
              
            ])
            ->filters([
        //
        ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('pdf')
                ->icon('heroicon-o-document-arrow-down')
                ->url(fn (Baptism $record)=>route('baptism.pdf', $record))
                ->openUrlInNewTab(),
                Tables\Actions\DeleteAction::make()
                ->successNotification(Notification::make()
                ->success()
                ->title('Baptism details created.')
                ->body('The detail is successfully deleted from the database')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    public static function Infolist(Infolist $infolist): Infolist
    {
        return $infolist
            //->record($this->confirmation)
            ->schema([
                Section::make('Baptism Details')
                    ->columns([
                        'sm' => 3,
                        'xl' => 6,
                        '2xl' => 8,
                    ])
                    ->schema([
                        TextEntry::make('person.full_name')->label('Name'),
                        TextEntry::make('bdate')->label('Date'),
                        TextEntry::make('place')->label('Place'),
                        TextEntry::make('sponsor')->label('Sponsor'),
                        TextEntry::make('minister')->label('Minister'),
                        TextEntry::make('person_id')->label('ID'), 
                        TextEntry::make('created_at')->label('Created At'),
                        TextEntry::make('updated_at')->label('Updated At'),
                    ])
                    ->columnSpan([
                        'sm' => 2,
                        'xl' => 3,
                        '2xl' => 4,
                    ]),
            ]);
    
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBaptisms::route('/'),
            'create' => Pages\CreateBaptism::route('/create'),
           // 'view' => Pages\ViewBaptism::route('/{record}'),
            'edit' => Pages\EditBaptism::route('/{record}/edit'),
        ];
    }
}
