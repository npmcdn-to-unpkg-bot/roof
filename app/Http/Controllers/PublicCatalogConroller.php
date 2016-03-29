<?php

namespace App\Http\Controllers;
use App\Comp;
use Image;
use Illuminate\Http\Request;
use App\Http\Requests;

class PublicCatalogConroller extends Controller
{
    public function index () {

    	$association = Comp::where('association', 1)
			->orderBy('created_at', 'desc')
			->take(10)
			->get();

    	$comps = Comp::orderBy('created_at', 'desc')
			->take(10)
			->get();

    	return view('public.catalog.index',[
    		'association' => $association,
    		'comps' => $comps
    	]);
    }
}
