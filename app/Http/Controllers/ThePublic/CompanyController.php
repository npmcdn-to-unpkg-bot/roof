<?php

namespace App\Http\Controllers\ThePublic;

use App\Models\Catalog\Company;
use App\Models\Catalog\Example;
use App\Models\Catalog\Specialisation;
use App\Models\Catalog\Proposition;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $companies = Company::orderBy('created_at', 'desc');
        if ($request->search) $companies = $companies->where('name', 'LIKE', '%'.$request->search.'%');
        if ($request->letter) $companies = $companies->where('name', 'LIKE', $request->letter.'%');
        $companies = $companies->paginate(10);

        return view('public.catalog.index', [
            'companies' => $companies,
            'search' => $request->search
        ]);
    }

   public function specialisation ($id) {

        return view('public.catalog.index', [
            'companies' => Specialisation::find($id)->companies()->orderBy('created_at', 'desc')->paginate(10)
        ]);

    }

    public function proposition ($id) {

        return view('public.catalog.index', [
            'companies' => Proposition::find($id)->companies()->orderBy('created_at', 'desc')->paginate(10)
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
        return view('public.catalog.show',[
            'company' => Company::with('buildings','posts','sales')->find($id)
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
        return view('public.catalog.example',[
            'example' => Example::find($id)
        ]);
    }

    public function price($name) {
        return response()->download(storage_path('app/prices/'.$name));
    }

}
