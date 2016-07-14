<?php

namespace App\Http\Controllers\Admin\Catalog;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Catalog\Company;
use Storage;
use App\User;
use Validator;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $company = Company::find($id);
        $members = $company->users;

        $th = [
                [
                    'title'=>'',
                    'width'=>'90px',
                ],[
                    'title'=>'Имя',
                    'width'=>'auto',
                ],[
                    'title'=>'Email',
                    'width'=>'auto',
                ],[
                    'title'=>'Должность',
                    'width'=>'auto',
                ],[
                    'title'=>'',
                    'width'=>'50px',
                ],[
                    'title'=>'',
                    'width'=>'90px',
                ],
        ];
        $table=collect()->push($th);
        foreach ($members as $member){
            $table->push([
                [
                    'field'=>$member->image,
                    'type'=>'image',
                ],[
                    'field'=>$member->name,
                    'type'=>'text',
                ],[
                    'field'=>$member->email,
                    'type'=>'text',
                ],[
                    'field'=>$member->job,
                    'type'=>'text',
                ],[
                    'html'=>$member->join_company_id ? '<a class="btn btn-sm btn-success" href="/admin/company/'.$company->id.'/staff/'.$member->id.'/accept" data-toggle="tooltip" data-original-title="Подтвердить"><i class="fa fa-check"></id></a>' : '',
                    'type'=>'html',
                ],[
                    'edit' => route('admin.users.edit', $member),
                    'delete' => route('admin.company.{company}.staff.destroy',['company'=>$company,'staff'=>$member]),
                    'type'=>'actions',
                ],
            ]);
        }
        return view('admin.catalog.index', [
            'table' => $table,
            'items' => $members,
            'company' => $company,
            'add' => route('admin.company.{company}.staff.create',$company),
            'title' => 'Сотрудники компании',
            'pagination' => false,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($company)
    {
        $company = Company::find($company);

        return view('admin.catalog.edit',[
            'title' => 'Добавить сотрудника',
            'action' => route('admin.company.{company}.staff.store', $company),
            'company' => $company,
            'fields' => [
                [
                    'name'=>'user_id',
                    'type'=>'select',
                    'settings'=>'',
                    'label'=>'Пользователь',
                    'value'=>'',
                    'options'=>User::lists('email','id')
                ]
            ]
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
        $validator = Validator::make($request->all(),[
            'user_id'=>'not_in:0'
        ],[
            'user_id.not_in'=>'Выберите пользователя'
        ]);
        if ($validator->fails())
            return back()->withInput()->withErrors($validator);
        User::where('id', $request->user_id)->update([
            'company_id' => $company
        ]);
        return redirect()->route('admin.company.{company}.staff.index',$company);
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
        //
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
    public function destroy($company, $id)
    {
        $company = Company::find($company);
        $company->users()->where('id',$id)->update([
            'company_id' => 0
        ]);
        return back();
    }

}
