<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Horse extends Model
{
    use HasFactory;

    protected $fillable = [
        'registered_name',
        'sex',
        'birth_date',
        'description',
        'status',
        'photo_url',
        'stat_speed',
        'stat_stamina',
        'stat_power',
        'stat_guts',
        'stat_wisdom',
        'breed_id',
        'stable_id',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
        ];
    }

    public function breed(): BelongsTo
    {
        return $this->belongsTo(Breed::class);
    }

    public function stable(): BelongsTo
    {
        return $this->belongsTo(Stable::class);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function listings(): HasMany
    {
        return $this->hasMany(Listing::class);
    }

    public function activeListing()
    {
        return $this->hasOne(Listing::class)->where('status', 'active');
    }
}
