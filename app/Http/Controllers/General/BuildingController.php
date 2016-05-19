<?php

namespace App\Http\Controllers\General;


use App\Models\Building\Building;
use App\Models\Building\Job;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\City;
use App\Country;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $buildings = Building::select('buildings.*')
            ->orderBy('created_at', 'desc')
            ->groupBy('buildings.id')
            ->distinct();


        if ($request) $buildings
            ->leftJoin('building_job','buildings.id','=','building_job.building_id')
            ->leftJoin('jobs','jobs.id','=','building_job.job_id')
            ->leftJoin('cities','buildings.city_id','=','cities.id');

        if (!empty($request->country)) 
            $buildings->where('cities.country_id',$request->country);

        if (!empty($request->city)) 
            $buildings->where('city_id',$request->city);

        if (!empty($request->type)) 
            $buildings->where('type',$request->type);

        if (!empty($request->speciality)) 
            $buildings->where('jobs.speciality',$request->speciality);

        if (!empty($request->seasonality)) 
            $buildings->where('jobs.seasonality',$request->seasonality);

        $map = clone $buildings;

        $cities = City::has('buildings')->get();
        $countries = Country::has('cities.buildings')->get();
        $types = Building::distinct()->lists('type');
        $specialities = Job::distinct()->lists('speciality');

        return view('general.buildings.index', [
            'buildings' => $buildings->paginate(9),
            'map' => $map->take(100)->get(),
            'cities' => $cities,
            'countries' => $countries,
            'types' => $types,
            'specialities' => $specialities
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
        $building = Building::with('company', 'jobs')->find($id);

        if (!$building) abort(404);
        
        return view('general.buildings.show', [
            'building' => $building
        ]);
    }

    public function edit()    { abort(404); }
    public function create()  { abort(404); }
    public function store()   { abort(404); }
    public function delete()  { abort(404); }

}
