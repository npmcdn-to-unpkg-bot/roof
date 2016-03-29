<?php

namespace App\Http\Controllers;
use App\Company;
use Image;
use Illuminate\Http\Request;
use App\Http\Requests;

class PublicCatalogConroller extends Controller
{
    public function index () {

    	$association = Company::where('association', 1)
			->orderBy('created_at', 'desc')
			->take(10)
			->get();

    	$companies = Company::orderBy('created_at', 'desc')
			->take(10)
			->get();

    	return view('public.catalog.index',[
    		'association' => $association,
    		'companies' => $companies
    	]);
    }
}
