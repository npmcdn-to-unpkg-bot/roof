<?php

namespace App\Http\Controllers\General;


use App\Models\Building\Building;
use App\Models\Building\Job;
use App\City;
use App\Country;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jobs = Job::select('jobs.*')->orderBy('created_at', 'desc')->distinct();


        if ($request)
            $jobs
                ->leftJoin('building_job','jobs.id','=','building_job.job_id')
                ->leftJoin('buildings','buildings.id','=','building_job.building_id')
                ->leftJoin('cities','buildings.city_id','=','cities.id');

        if (!empty($request->country)) 
            $jobs->where('cities.country_id',$request->country);

        if (!empty($request->city)) 
            $jobs->where('cities.id',$request->city);

        if (!empty($request->type)) 
            $jobs->where('buildings.type',$request->type);

        if (!empty($request->speciality)) 
            $jobs->where('speciality',$request->speciality);

        if (!empty($request->seasonality)) 
            $jobs->where('seasonality',(int)$request->seasonality);

        $map=collect();

        $cities = City::has('buildings')->get();
        $countries = Country::has('cities.buildings')->get();
        $types = Building::distinct()->lists('type');
        $specialities = Job::distinct()->lists('speciality');

        return response()->general('buildings.jobs', [
            'jobs' => $jobs->paginate(20),
            'map' => $map,
            'cities' => $cities,
            'countries' => $countries,
            'types' => $types,
            'specialities' => $specialities
        ]);
    }

}
