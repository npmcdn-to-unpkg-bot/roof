<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    function index() {
		return view('general.search.index');
    }

    public function show()    { abort(404); }
    public function edit()    { abort(404); }
    public function create()  { abort(404); }
    public function store()   { abort(404); }
    public function delete()  { abort(404); }
}
