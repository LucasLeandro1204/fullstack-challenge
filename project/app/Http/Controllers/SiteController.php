<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

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
