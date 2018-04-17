<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'fields',
    ];

    /**
     * Field relation.
     */
    public function fields(): HasMany
    {
        return $this->hasMany(Field::class);
    }
}
