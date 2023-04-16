<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Document;
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
        $categories_count = Category::count();
        $documents_count = Document::count();
        return Inertia::render('cpanel', compact('categories_count', 'documents_count'));
    }
}
