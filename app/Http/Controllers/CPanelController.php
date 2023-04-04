<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class CPanelController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {

        return Inertia::render('cpanel');
    }
}
