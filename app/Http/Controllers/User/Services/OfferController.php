<?php

namespace App\Http\Controllers\User\Services;

use Illuminate\Http\Request;
use App\Offer;
use App\Category;
use Validator;
use Storage;
use Auth;
use App\Country;
use App\City;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Service;

class OfferController extends Controller
{

    protected function fields (Offer $offer) {

        return [
            [
                'name'=>'offer_framed',
                'type'=>'service',
                'expire' => $offer->framed
            ],[
                'name'=>'offer_top',
                'type'=>'service',
                'expire' => $offer->top
            ]
        ];
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->offer_framed)
            $order = $offer->orders()->create([
                'user_id' => auth()->user()->id,
                'service_id' => $request->offer_framed
            ]);

        if ($request->offer_top)
            $order = $offer->orders()->create([
                'user_id' => auth()->user()->id,
                'service_id' => $request->offer_top
            ]);

        if ($request->offer_top||$request->offer_framed)
            return redirect()->route('user.orders.index');

        return redirect()->route('user.offers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $offer = Auth::user()->offers()->where('id', $id)->first();
        if (!$offer) return redirect()->route('user.offer.create');

        return view('admin.universal.edit',[
            'title' => 'Рекламировать объявление',
            'action' => route('user.offers.store'),
            'fields' => $this->fields($offer),
            'item' => $offer
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Auth::user()->offers()->where('id', $id)->delete();
        return back();
    }
    
    public function up($id)
    {
        $order = Offer::find($id)->orders()->create([
            'user_id' => auth()->user()->id,
            'service_id' => Service::where('group','offer_up')->first()->id
        ]);
        return redirect()->route('user.orders.index');
    }
}
