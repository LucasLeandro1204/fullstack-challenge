<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Resources\Category as CategoryResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryController extends Controller
{
    /**
     * List categories.
     */
    public function __invoke(): ResourceCollection
    {
        return CategoryResource::collection(
            Category::with('fields')->get()
        );
    }
}
