<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Support\Collection;

class CategoryController extends Controller
{
    /**
     * List categories.
     */
    public function __invoke(): Collection
    {
        return Category::with('fields')->get();
    }
}
