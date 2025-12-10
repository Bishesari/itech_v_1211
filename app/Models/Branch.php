<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Branch extends Model
{
    protected $fillable = [
        'name', 'code', 'province_id', 'city_id', 'address',
        'postal_code', 'phone', 'mobile', 'active'
    ];

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function users():BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot(['role_id', 'assigned_by'])
            ->withTimestamps();
    }
}
