<?php

namespace App\Http\Controllers\ThePublic;


use App\Building;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buildings = Building::orderBy('created_at', 'desc')->paginate(9);
        return view('public.buildings.index', [
            'buildings' => $buildings
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
        return view('public.buildings.building', [
            'building' => Building::find($id)
        ]);
    }

}
