<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Advertisement extends Model
{
    /**
     * Fields value relation.
     */
    public function values(): HasMany
    {
        return $this->hasMany(Value::class);
    }
}
