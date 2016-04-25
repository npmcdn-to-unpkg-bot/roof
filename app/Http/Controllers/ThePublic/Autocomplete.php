<?php

namespace App\Http\Controllers\ThePublic;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Autocomplete extends Controller
{
    public function country (Request $request) {
    	return response()->json(
        [
            'results' =>\App\Country::take(5)
                ->where('name','like',$request->term.'%')
                ->select('name as text', 'id')
                ->get()
        ],
        200,[],JSON_UNESCAPED_UNICODE);
    }

    public function city (Request $request) {
        return response()->json(
        [
            'results' =>\App\City::take(5)
                ->where('name','like',$request->term.'%')
                ->where('country_id',$request->country)
                ->selectRaw('CONCAT(name," ",region," ",state) as text, id')
                ->get()
        ],
        200,[],JSON_UNESCAPED_UNICODE);
    }
}
