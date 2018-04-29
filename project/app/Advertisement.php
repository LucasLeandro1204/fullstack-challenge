<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Advertisement extends Model
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'category',
    ];

    /**
     * Fields value relation.
     */
    public function values(): HasMany
    {
        return $this->hasMany(Value::class);
    }

    /**
     * The advertisement category.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
