<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

use App\Models\Person;


class Baptism extends Model
{
   
    use HasFactory;
    protected $table= 'baptisms';

    protected $fillable = [
        'person_id', 'bdate', 'place', 'sponsor', 'minister'
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
/*Forms\Components\Select::make('person_id')
                ->relationship(name: 'person', titleAttribute: 'cname')
                ->columnSpan('full')
                ->native(false)
                ->label('Person ID')
                ->required(),*/