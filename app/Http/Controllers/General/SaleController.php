<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Sale;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::orderBy('created_at', 'desc')
            ->where(function($query){
                $query
                    ->whereRaw('start <  NOW()')
                    ->orWhereRaw('start = "0000-00-00 00:00:00"');
            })
            ->where(function($query){
                $query
                    ->whereRaw('end >=  NOW()')
                    ->orWhereRaw('end = "0000-00-00 00:00:00"');
            })
            ->paginate(15);
        return view('general.sales.index', [
            'sales' => $sales
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
        $sale = Sale::find($id);

        if (!$sale) abort(404);

        return view('general.sales.show', [
            'sale' => $sale
        ]);
    }

    public function edit()    { abort(404); }
    public function create()  { abort(404); }
    public function store()   { abort(404); }
    public function delete()  { abort(404); }
    
}
