<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stable extends Model
{
    use HasFactory;

    protected $fillable = ['stable_name', 'address', 'province'];

    public function horses(): HasMany
    {
        return $this->hasMany(Horse::class);
    }
}
