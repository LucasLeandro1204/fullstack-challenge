<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
     * Show app view.
     */
    public function __invoke(): View
    {
        return view('app');
    }
}
