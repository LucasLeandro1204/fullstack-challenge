<?php

namespace App\Core;

use Illuminate\Http\Request;

interface QueryInterface
{
    /**
     * Create a new query instance from request.
     */
    public static function from(Request $request): self;
}
