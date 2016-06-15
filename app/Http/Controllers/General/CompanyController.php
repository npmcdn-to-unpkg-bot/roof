<?php

namespace App\Http\Controllers\General;

use App\Models\Catalog\Company;
use App\Models\Catalog\Example;
use App\Models\Catalog\Specialisation;
use App\Models\Catalog\Proposition;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $companies = Company::orderBy('level','desc')
                        ->orderBy(DB::raw('level*max_level_start'))
                        ->orderBy('rating', 'desc')
                        ->orderBy('created_at', 'desc');

        if ($request->search) {
            $companies = $companies->where('name', 'LIKE', '%'.$request->search.'%');
        }
        if ($request->letter){ 
            $companies = $companies->where('name', 'LIKE', $request->letter.'%'); 
            $XRobotsTag = 'noindex';
        }else{
            $XRobotsTag = 'all';
        }

        $companies = $companies->paginate(10);

        foreach ($companies as &$company) {
            $company->rating
                = $company->comments()->avg('rating')*0.7 
                + $company->association 
                + $company->level*0.2;
            Company::where('id', $company->id)->update(['rating'=>$company->rating]);
        }

        return response()
            ->view('general.catalog.index', [
                'companies' => $companies,
                'search' => $request->search
            ])
            ->header('X-Robots-Tag', $XRobotsTag);;
    }

   public function specialisation ($id) {

        return view('general.catalog.index', [
            'companies' => Specialisation::find($id)
                        ->companies()
                        ->orderBy('level','desc')
                        ->orderBy(DB::raw('level*max_level_start'))
                        ->orderBy('rating', 'desc')
                        ->orderBy('created_at', 'desc')
                        ->paginate(10)
        ]);

    }

    public function proposition ($id) {

        return view('general.catalog.index', [
            'companies' => Proposition::find($id)
                        ->companies()
                        ->orderBy('level','desc')
                        ->orderBy(DB::raw('level*max_level_start'))
                        ->orderBy('rating', 'desc')
                        ->orderBy('created_at', 'desc')
                        ->paginate(10)
        ]);

    }

    public function sale ($company_id, $sale_id) {

        $company = Company::find($company_id);
        $sale = $company->sales()->find($sale_id);

        if (!$sale) abort(404);

        return view('general.sales.show', [
            'sale' => $sale
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

        $company = Company::with('buildings','posts','sales','comments')->find($id);
        $company->rating
            = $company->comments()->avg('rating')*0.7 
            + $company->association 
            + $company->level*0.2;
        Company::where('id', $company->id)->update(['rating'=>$company->rating]);

        if (!$company) abort(404);

        return view('general.catalog.show',[
            'company' => $company
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function example($id)
    {
        return view('general.catalog.example',[
            'example' => Example::find($id)
        ]);
    }

    public function price($name) {
        return response()->download(storage_path('app/prices/'.$name));
    }

    public function join ($id) {
        auth()->user()->update(['join_company_id'=>$id]);
        
        return back();
    }

    public function edit()    { abort(404); }
    public function create()  { abort(404); }
    public function store()   { abort(404); }
    public function delete()  { abort(404); }

}
