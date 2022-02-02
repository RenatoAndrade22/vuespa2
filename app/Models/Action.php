<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Action extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function investments() :hasMany
    {
        return $this->hasMany(Investiment::class);
    }

}
