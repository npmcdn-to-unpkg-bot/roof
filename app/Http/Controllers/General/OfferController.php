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
        $categories = explode(',',$request->categories);
        if ($request->search) $offers->where('title', 'LIKE', '%'.$request->search.'%');
        if ($request->created_at) $offers->where('created_at', '>=', Carbon::now()->subWeek($request->created_at));
        if ($request->categories) $offers->whereHas('categories',
        function ($query) use ($categories) {
            return $query->whereIn('id', $categories);
        });
        $offers = $offers->paginate(10);
        return view('general.desk.index',[
            'offers' => $offers,
            'categories' => $categories
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

        $offer = Offer::find($id);

        if (!$offer) abort(404);

        return view('general.desk.show',[
            'offer' => $offer
        ]); 
    }

    public function edit()    { abort(404); }
    public function create()  { abort(404); }
    public function store()   { abort(404); }
    public function delete()  { abort(404); }

}
