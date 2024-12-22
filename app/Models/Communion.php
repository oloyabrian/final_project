<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Communion extends Model
{
    use HasFactory;
    protected $fillable=[
        'person_id',
        'cdate',
        'cplace',
        
    ];  
    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }
}
