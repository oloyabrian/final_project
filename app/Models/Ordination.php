<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Ordination extends Model
{
    use HasFactory;
    protected $fillable=[
        'ord_date',
        'minister',
    ];
    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }
}
