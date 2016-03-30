<?php

namespace App\Http\Controllers;
use App\Company;
use App\Specialisation;
use App\Proposition;
use Image;
use Illuminate\Http\Request;
use App\Http\Requests;

class PublicCatalogConroller extends Controller
{
    public function index () {

        $specialisations = Specialisation::all();

        $propositions = Proposition::all();

    	$companies = Company::orderBy('created_at', 'desc')
			->take(10)
			->get();

    	return view('public.catalog.index',[
    		'specialisations' => $specialisations,
            'propositions' => $propositions,
    		'companies' => $companies
    	]);
    }
}
