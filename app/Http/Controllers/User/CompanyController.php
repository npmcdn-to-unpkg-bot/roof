<?php

namespace App\Http\Controllers\User;

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
            ->where('value','>=',$company->level)
            ->get();
        return [
            [
                'name' => 'name',
                'type' => 'text',
                'placeholder' => 'Введите название компании',
                'label' => 'Название компании',
                'value' => old() ? old('name') : $company->name
            ],[
                'name' => 'logo',
                'type' => 'images',
                'label' => 'Логотип',
                'quantity' => 1,
                'values' => old() 
                    ? (array)old('logo') 
                    : (array)$company->logo
            ],[
                'name' => 'entry',
                'type' => 'textarea',
                'placeholder' => 'Введите краткое описание компании',
                'label' => 'Краткое описание компании',
                'value' => old() ? old('entry') : $company->entry
            ],[
                'name' => 'about',
                'type' => 'ckeditor',
                'label' => 'О компании',
                'value' => old() ? old('about') : $company->about
            ],[
                'name' => 'services',
                'type' => 'ckeditor',
                'label' => 'Описание услуг компании',
                'value' => old() ? old('services') : $company->services
            ],[
                'name' => 'email',
                'type' => 'text',
                'placeholder' => 'Введите email компании',
                'label' => 'Email компании',
                'value' => old() ? old('email') : $company->email
            ],[
                'name' => 'phone',
                'type' => 'text',
                'placeholder' => 'Введите телефон компании',
                'label' => 'Телефон компании',
                'value' => old() ? old('phone') : $company->phone
            ],[
                'name'=>'company_level',
                'type'=>'company_level',
                'label'=>'Статус компании',
                'value' => old() ? old('company_level') : $level->where('value', (string)$company->level)->first()['id'],
                'options' => $level,
            ],[
                'type' => 'address',
                'label' => 'Адрес',
                'lat' => old() ? old('lat') : $company->lat,
                'lng' => old() ? old('lng') : $company->lng,
                'country' => old() 
                    ? Country::firstOrNew(['id'=>old('country_id')])
                    : ($company->city ? $company->city->country : new Country),
                'city' => old() 
                    ? City::firstOrNew(['id'=>old('city_id')])
                    : ($company->city ? $company->city : new Country),
                'address' => old() 
                    ? old('address') 
                    : $company->address
            ],[
                'name' => 'specialisations',
                'type' => 'select_multiple',
                'label' => 'Специализации',
                'values' => old() ? (array)old('specialisations') : $company->specialisations->lists('id')->all(),
                'options' => Specialisation::lists('name','id')
            ],[
                'name' => 'propositions',
                'type' => 'select_multiple',
                'label' => 'Предложения',
                'values' => old() ? (array)old('propositions') : $company->propositions->lists('id')->all(),
                'options' => Proposition::lists('name','id')
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
        $validator = Company::validator($request->all());
        if ($validator->fails())
            return back()->withInput()->withErrors($validator);

        $company = Auth::user()
            ->company()
            ->firstOrNew(['id' => $request->id]);

        if ($request->image&&Storage::exists('temp/'.$request->logo)) 
            Storage::move('temp/'.$request->logo,'images/'.$request->logo);
        
        if ($company->logo&&$company->logo!==$request->logo) 
            Storage::delete('images/'.$company->logo);

        $company
            ->fill($request->only('name','email','logo','phone','entry','about','address','lat','lng','city_id','services'))
            ->save();
        $company->specialisations()->sync($request->specialisations ? $request->specialisations : []);
        $company->propositions()->sync($request->propositions ? $request->propositions : []);

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
        $user = Auth::user();
        $company = $user->company ? $user->company : new Company;

        return view('admin.universal.edit',[
            'title' => $user->company ? 'Редактировать компанию' : 'Добавить компанию',
            'action' => route('user.company.store'),
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
        Auth::user()->company->delete();
        return back();
    }
}
