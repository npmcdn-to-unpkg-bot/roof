<?php

namespace App\Http\Controllers\ThePublic;

use Illuminate\Http\Request;

use App\Offer;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $offers = Offer::orderBy('created_at', 'desc');
        if ($request->search) $offers = $offers->where('title', 'LIKE', '%'.$request->search.'%');
        $offers = $offers->paginate(10);
        return view('public.desk.index',[
            'offers' => $offers,
            'search' => $request->search
        ]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('public.desk.show',[
            'offer' => Offer::find($id)
        ]); 
    }

}
