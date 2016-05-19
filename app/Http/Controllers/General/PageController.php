<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Page;

class PageController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        if ($slug=='contacts') return view('general.pages.contacts');
        $page = Page::where('slug', $slug)->first();
        if (!$page) abort('404');
        return view('general.pages.show', [
            'page' => $page
        ]);
    }
    
}
