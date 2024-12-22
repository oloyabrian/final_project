<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Marriage extends Model
{
    use HasFactory;
    protected $fillable=[
       'spouse',
        'marriage_date',
        'matron',
        'patron',
    ];
    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }
}
