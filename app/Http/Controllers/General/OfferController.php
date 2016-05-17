<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;

use Carbon\Carbon;
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
        if ($request->created_at) $offers = $offers->where('created_at', '>=', Carbon::now()->subWeek($request->created_at));
        $offers = $offers->paginate(10);
        return view('general.desk.index',[
            'offers' => $offers
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
        return view('general.desk.show',[
            'offer' => Offer::find($id)
        ]); 
    }

}
