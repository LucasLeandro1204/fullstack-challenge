<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Advertisement;
use App\Queries\SearchAdvertisements;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AdvertisementController extends Controller
{
    /**
     * List advertisements.
     */
    public function index(Request $request): ResourceCollection
    {
        return Advertisement::collection(
            SearchAdvertisements::from($request)->get()
        );
    }
}
