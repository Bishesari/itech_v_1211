<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Contact extends Model
{
    public function users():belongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withTimestamps();
    }
}
