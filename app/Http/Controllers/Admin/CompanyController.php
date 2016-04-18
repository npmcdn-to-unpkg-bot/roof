<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Auth;
use Image;
use Validator;
use App\Company;
use App\Specialisation;
use App\Proposition;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{

    protected $table = [
        [
            'field'=>'logo',
            'type'=>'image',
            'width'=>'40px',
            'title'=>'Логотип'
        ],[
            'field'=>'name',
            'type'=>'text',
            'width'=>'auto',
            'title'=>'Название компании'
        ],[
            'field'=>'user',
            'type'=>'user',
            'width'=>'10%',
            'title'=>'Пользователь'
        ],[
            'field'=>'specialisations',
            'type'=>'taxonomy',
            'width'=>'20%',
            'title'=>'Специализации'
        ],[
            'field'=>'propositions',
            'type'=>'taxonomy',
            'width'=>'20%',
            'title'=>'Предложения'
        ],[
            'field'=>'id',
            'type'=>'actions',
            'width'=>'90px',
            'title'=>''
        ],
    ];

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
                'type' => 'image',
                'label' => 'Логотип компании',
                'value' => old() ? old('logo') : $company->logo
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
                'name' => 'specialisations',
                'type' => 'taxonomy',
                'label' => 'Специализации',
                'values' => old() ? old('specialisations') : $company->specialisations->map(function ($specialisation) {return $specialisation->id;})->all(),
                'taxonomy' => Specialisation::all()
            ],[
                'name' => 'propositions',
                'type' => 'taxonomy',
                'label' => 'Предложения',
                'values' => old() ? old('propositions') : $company->propositions->map(function ($proposition) {return $proposition->id;})->all(),
                'taxonomy' => Proposition::all()
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

        return view('admin.table', [
            'table' => $this->table,
            'items' => $companies,
            'title' => 'Компании',
            'links' => [
                'show' => 'admin.company.show',
                'edit' => 'admin.company.edit',
                'delete' => 'admin.company.destroy'
            ]
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

        return view('admin.form',[
            'title' => 'Добавить компанию',
            'action' => 'admin.company.store',
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
        if ($request->hasFile('upload')) {
            $extension = $request->file('upload')->getClientOriginalExtension();
            $name = $request->file('upload')->getClientOriginalName();
            $name = str_slug( str_replace ( $extension, '', $name ) );
            $image = time() . '-' . $name . '.' . $extension;
            Image::make($request
                ->file('upload'))
                ->resize(1600, 1024, function ($constraint) { $constraint->upsize(); })
                ->save(storage_path('app/images/').$image);
            $request->merge(['logo' => $image]);
        }

        $validator = Validator::make($request->all(), Company::$rules, Company::$messages);

        if ($validator->fails())
            return back()->withInput()->withErrors($validator);

        $company = Company::firstOrNew(['id' => $request->id])
            ->fill($request->only('name','email','logo','phone','entry','about','services','association','privat'));
        $company->save();
        $company->specialisations()->sync($request->specialisations ? $request->specialisations : []);
        $company->propositions()->sync($request->propositions ? $request->propositions : []);

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

        return view('admin.form',[
            'title' => 'Добавить компанию',
            'action' => 'admin.company.store',
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