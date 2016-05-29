<?php

namespace App\Http\Controllers\User\Services;

use Illuminate\Http\Request;
use Auth;
use Storage;
use App\Country;
use App\City;
use App\Models\Catalog\Company;
use App\Models\Catalog\Specialisation;
use App\Models\Catalog\Proposition;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Service;

class CompanyController extends Controller
{

    public function fields (Company $company) {
        $level = Service::where('group','company_level')
            ->where('value','>=',$company->level ? $company->level : 0)
            ->get();

        return [
            [
                'name'=>'company_level',
                'type'=>'company_level',
                'label'=>'Статус компании',
                'value' => old() ? old('company_level') : $level->where('value', (string)$company->level)->first()['id'],
                'options' => $level,
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
        return $this->edit();
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $company = auth()
            ->user()
            ->company()
            ->firstOrNew(['id' => $request->id]);

        $service = Service::find($request->company_level);
        if ( $service  && ($company->level < $service->value) ) {
            $company->orders()->create([
                'user_id' => auth()->user()->id,
                'service_id' => $request->company_level
            ]);
            return redirect()->route('user.orders.index');
        }

        return redirect('user');
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
    public function edit($id = 0)
    {
        $user = auth()->user();
        $company = $user->company ? $user->company : new Company;

        return view('admin.universal.edit',[
            'title' => 'Рекламировать компанию',
            'action' => route('user.company.services.store'),
            'fields' => $this->fields($company),
            'item' => $company
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
        //
    }
}
