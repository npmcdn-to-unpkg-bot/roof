<?php

namespace App\Http\Controllers\ThePublic;


use App\Building;
use App\Job;
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
        $buildings = Building::with('company','jobs','images')
            ->orderBy('created_at', 'desc')
            ->paginate(9);
        $jobs = Job::orderBy('created_at', 'desc')
            ->paginate(20);
        return view('public.buildings.index', [
            'buildings' => $buildings,
            'jobs' => $jobs
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
            'building' => Building::with('company', 'jobs')->find($id)
        ]);
    }

}
