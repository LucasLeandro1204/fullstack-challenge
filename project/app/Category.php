<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    /**
     * Field relation.
     */
    public function fields(): HasMany
    {
        return $this->hasMany(Field::class);
    }
}
