<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Confirmation extends Model
{
    use HasFactory;
    protected $fillable=[
        'person_id',
        'confirmdate',
        'confirmplace',
    ];
    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }
}
