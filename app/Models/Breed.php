<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Breed extends Model
{
    use HasFactory;

    protected $fillable = ['breed_name', 'origin_country'];

    public function horses(): HasMany
    {
        return $this->hasMany(Horse::class);
    }
}
