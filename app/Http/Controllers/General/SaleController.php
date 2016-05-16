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
        $sales = Sale::orderBy('created_at', 'desc')->paginate(15);
        return response()->general('sales.index', [
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
        return response()->general('sales.show', [
            'sale' => Sale::find($id)
        ]);
    }
}
