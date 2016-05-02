<?php

namespace App\Http\Controllers\Admin\Catalog;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Catalog\Member;
use App\Models\Catalog\Company;
use Storage;

class MemberController extends Controller
{

    protected function fields (Member $member) {

        return [
            [
                'name'=>'name',
                'type'=>'text',
                'placeholder'=>'Введите имя сотрудника',
                'label'=>'Имя',
                'value'=>old() ? old('name') : $member->name
            ],[
                'name'=>'job',
                'type'=>'text',
                'placeholder'=>'Введите должность сотрудника',
                'label'=>'Должность',
                'value'=>old() ? old('job') : $member->job
            ],[
                'name' => 'image',
                'type' => 'images',
                'label' => 'Фотография',
                'quantity' => 1,
                'values' => old() 
                    ? (array)old('image') 
                    : (array)$member->image
            ],[
                'name'=>'company_id',
                'type'=>'select',
                'settings'=>'',
                'label'=>'Комания',
                'value'=>old() 
                    ? old('company_id') 
                    : ($member->company ? $member->company->id : ''),
                'options'=>Company::lists('name','id')
            ]
        ];
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($company)
    {
        $members = Company::find($company)->members()->paginate(15);
        $company = Company::find($company);

        $th = [
            [
                'title'=>'Картинка',
                'width'=>'40px',
            ],[
                'title'=>'ФИО',
                'width'=>'auto',
            ],[
                'title'=>'Должность',
                'width'=>'auto',
            ],[
                'title'=>'',
                'width'=>'90px',
            ]
        ];
        $table=collect()->push($th);
        foreach ($members as $member) {
            $table->push([
                [
                    'type'=>'image',
                    'field'=>$member->image,
                ],[
                    'type'=>'text',
                    'field'=>$member->name,
                ],[
                    'type'=>'text',
                    'field'=>$member->job,
                ],[
                    'type'=>'actions',
                    'edit' => route('admin.company.{company}.staff.edit',['company'=>$company,'staff'=>$member]),
                    'delete' => route('admin.company.{company}.staff.destroy',['company'=>$company,'staff'=>$member]),
                ],
            ]);
        }

        return view('admin.catalog.index', [
            'table' => $table,
            'title' => 'Сотрудники',
            'company' => $company,
            'add' => route('admin.company.{company}.staff.create',$company),
            'pagination' => $members->render()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($company)
    {
        $member = new Member(['company_id'=>$company]);
        $company = Company::find($company);

        return view('admin.catalog.edit',[
            'title' => 'Добавить сотрудника',
            'action' => route('admin.company.{company}.staff.store',$company),
            'company' => $company,
            'fields' => $this->fields($member),
            'item' => $member
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $company)
    {
        $validator = Member::validator($request->all());
        if ($validator->fails())
            return back()->withInput()->withErrors($validator);

        $member = Member::firstOrNew(['id' => $request->id]);

        if (Storage::exists('temp/'.$request->image)) 
            Storage::move('temp/'.$request->image,'images/'.$request->image);
        if ($member->image&&$member->image!==$request->image) 
            Storage::delete('images/'.$company->image);

        $member->fill($request->only('name','image','job','company_id'));
        $member->save();

        return redirect()->route('admin.company.{company}.staff.index', $company);
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
    public function edit($company, $id)
    {
        $member = Member::find($id);
        $company = Company::find($company);

        return view('admin.catalog.edit',[
            'title' => 'Редактировать сотрудника',
            'action' => route('admin.company.{company}.staff.store',$company),
            'company' => $company,
            'fields' => $this->fields($member),
            'item' => $member
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
        Member::find($id)->delete();
        return back();
    }
}
