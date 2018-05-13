<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Advertisement;
use App\Queries\SearchAdvertisements;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AdvertisementController extends Controller
{
    /**
     * Search advertisements class.
     *
     * @var SearchAdvertisements.
     */
    protected $search;

    /**
     * Create a new resource.
     */
    public function __construct(SearchAdvertisements $search)
    {
        $this->search = $search;
    }

    /**
     * List advertisements.
     */
    public function index(Request $request): ResourceCollection
    {
        return Advertisement::collection(
            $this->search->from($request)->get()
        );
    }
}
