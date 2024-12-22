<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\MarriageResource\Pages;
use App\Filament\App\Resources\MarriageResource\RelationManagers;
use App\Models\Marriage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Filament\Infolists\Components\Section;
use Filament\Notifications\Notification;


class MarriageResource extends Resource
{
    protected static ?string $model = Marriage::class;
    protected static ?string $navigationIcon = 'heroicon-o-arrows-pointing-in';
    protected static ?string $navigationGroup = 'Sacrament Management';
    protected static ?string $navigationLabel = 'Marriage';
    protected static ?string $modelLabel = 'Marriage';

    protected static ?int $navigationSort = 2;
    protected static ?string $recordTitleAttribute = 'spouse';
    public static function getGlobalSearchResultTitle (Model $record): string
    {
        return $record->person->sname;
    }
    public static function getGloballySearchableAttributes(): array
    {
        return ['person.sname',
        'person.cname',
        'patron',
        'spouse',
        'matron',
        'person.oname',
        'person.village',
        'person.address'
        ];
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
                ->orWhere('patron', 'like', "%{$search}%")
                ->orWhere('spouse', 'like', "%{$search}%")
                ->orWhere('matron', 'like', "%{$search}%");
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
               ->preload()
               ->searchable()
                ->label('Person ID')
                ->required(),
                Forms\Components\TextInput::make('spouse')
                    ->required()
                    ->label('Spouse')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('marriage_date')
                    ->required()
                    ->displayFormat('d/m/Y')
                    ->label('Wedding Date')
                    ->native(false),
                Forms\Components\TextInput::make('matron')
                    ->required()
                    ->label('Matron')
                    ->maxLength(255),
                Forms\Components\TextInput::make('patron')
                    ->required()
                    ->label('Patron')
                    ->maxLength(255),
                    Forms\Components\Select::make('person_id')
                ->relationship(name: 'person', titleAttribute: 'cname')
                    ->label('Name')
                    ->preload()
               ->searchable()
                    ->native(false)
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
                Tables\Columns\TextColumn::make('spouse')
                ->label('Spouse')
                ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('marriage_date')
                ->label('Wedding Date')
                ->date('d/m/Y')
                ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('matron')
                ->label('Matron')
                ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('patron')
                ->label('Patron')
                ->sortable()
                    ->searchable(),
                   Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Created At')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->label('Updated At')
                    
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
                ->url(fn (Marriage $record)=>route('marriage.pdf', $record))
                ->openUrlInNewTab(),
                Tables\Actions\DeleteAction::make()
                ->successNotification(Notification::make()
                ->success()
                ->title('Marriage details created.')
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
                Section::make('Marriage Details')
                    ->columns([
                        'sm' => 3,
                        'xl' => 6,
                        '2xl' => 8,
                    ])
                    ->schema([
                        TextEntry::make('person.full_name')->label('Name'),
                        TextEntry::make('spouse')->label('Spouse'),
                        TextEntry::make('marriage_date')->label('Date'),
                        TextEntry::make('matron')->label('Matron'),
                        TextEntry::make('patron')->label('Patron'),
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
            'index' => Pages\ListMarriages::route('/'),
            'create' => Pages\CreateMarriage::route('/create'),
           // 'view' => Pages\ViewMarriage::route('/{record}'),
            'edit' => Pages\EditMarriage::route('/{record}/edit'),
        ];
    }
}
