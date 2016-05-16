<?php

namespace App\Http\Controllers\Admin\Catalog;

use Illuminate\Http\Request;
use Auth;
use Storage;
use App\User;
use App\Models\Catalog\Company;
use App\Country;
use App\City;
use App\Models\Catalog\Specialisation;
use App\Models\Catalog\Proposition;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{

    public function fields (Company $company) {
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
                'name' => 'association',
                'type' => 'checkbox',
                'label' => 'Член ассоциации',
                'value' => old() ? old('association') : $company->association
            ],[
                'name' => 'privat',
                'type' => 'checkbox',
                'label' => 'Частный мастер',
                'value' => old() ? old('privat') : $company->privat
            ],[
                'name'=>'level',
                'type'=>'radio',
                'label'=>'Статус компании',
                'value' => old() ? old('level') : $company->level,
                'options'=>[
                    '0' => 'Нет',
                    '1' => 'Старт',
                    '2' => 'Бизнес',
                    '3' => 'Премиум',
                ],
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
            ],[
                'name'=>'user_id',
                'type'=>'select',
                'settings'=>'',
                'label'=>'Пользователь',
                'value'=>old() 
                    ? old('user_id') 
                    : ($company->user ? $company->user->id : ''),
                'options'=>User::lists('email','id')
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

        $companies = Company::orderBy('created_at', 'DESC')->paginate(15);        

        $th=[
                [
                    'title'=>'Логотип',
                    'width'=>'40px',
                ],[
                    'title'=>'Название компании',
                    'width'=>'auto',
                ],[
                    'title'=>'Пользователь',
                    'width'=>'10%',
                ],[
                    'title'=>'Специализации',
                    'width'=>'20%',
                ],[
                    'title'=>'Предложения',
                    'width'=>'20%',
                ],[
                    'title'=>'',
                    'width'=>'90px',
                ]
            ];
        $table=collect()->push($th);
        foreach ($companies as $company) {
            $table->push([
                [
                    'type'=>'image',
                    'field'=>$company->logo,
                ],[
                    'type'=>'text',
                    'field'=>$company->name,
                ],[
                    'type'=>'user',
                    'field'=>$company->user,
                ],[
                    'type'=>'taxonomy',
                    'field'=>$company->specialisations,
                ],[
                    'type'=>'taxonomy',
                    'field'=>$company->propositions,
                ],[
                    'type'=>'actions',
                    'edit' => route('admin.company.edit', $company),
                    'delete' => route('admin.company.destroy', $company)
                ],
            ]);
        }

        return view('admin.universal.index', [
            'title' => 'Компании',
            'table' => $table,
            'pagination' => $companies->render(),
        ]);

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = new Company;

        return view('admin.universal.edit',[
            'title' => 'Добавить компанию',
            'action' => route('admin.company.store'),
            'fields' => $this->fields($company),
            'item' => $company
        ]);
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

        $company = Company::firstOrNew(['id' => $request->id]);

        if (Storage::exists('temp/'.$request->logo)) 
            Storage::move('temp/'.$request->logo,'images/'.$request->logo);
        if ($company->logo&&$company->logo!==$request->logo) 
            Storage::delete('images/'.$company->logo);

        $company
            ->fill($request->only('name','email','logo','phone','entry','about','services','association','privat','user_id','level','address','lat','lng','city_id'))
            ->save();
        $company->specialisations()->sync((array)$request->specialisations);
        $company->propositions()->sync((array)$request->propositions);

        return redirect()->route('admin.company.index');
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
    public function edit($id)
    {
        $company = Company::find($id);

        return view('admin.catalog.edit',[
            'title' => 'Редактировать компанию',
            'action' => route('admin.company.store'),
            'company' => $company,
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
        Company::find($id)->delete();
        return back();
    }
}
