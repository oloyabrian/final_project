<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Baptism;

class Person extends Model
{
    
    use HasFactory;
    use SoftDeletes;
    public function getFullNameAttribute()
    {
        return "{$this->sname} {$this->cname}";
    }
    public function scopeWhereFullName($query, $name)
    {
        $query->whereRaw("CONCAT(sname, ' ', cname) LIKE ?", ["%{$name}%"]);
    }
    public function baptisms(): HasMany
    {
        return $this->hasMany(Baptism::class);
    }

    public function communions(): HasMany
    {
        return $this->hasMany(Communion::class);
    }

    public function confirmations(): HasMany
    {
        return $this->hasMany(Confirmation::class);
    }

    public function marriages(): HasMany
    {
        return $this->hasMany(Marriage::class);
    }

    public function ordinations(): HasMany
    {
        return $this->hasMany(Ordination::class);
    }
    protected $table = "persons";
    protected $fillable =[
        'cname',
        'sname',
        'oname',
        'gender',
        'dob',
        'fname',
        'mname',
        'village',
        'tel',
        'address',
        'email',
    ];
}
