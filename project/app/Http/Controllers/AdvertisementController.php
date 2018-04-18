<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Queries\SearchAdvertisements;
use App\Http\Resources\AdvertisementResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AdvertisementController extends Controller
{
    /**
     * List advertisements.
     */
    public function index(Request $request): ResourceCollection
    {
        return AdvertisementResource::collection(
            SearchAdvertisements::from($request)->get()
        );
    }
}
