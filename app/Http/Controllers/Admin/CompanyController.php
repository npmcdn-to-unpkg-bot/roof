<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Auth;
use App\Company;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $table = [
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

        $companies = Company::paginate(15);        

        return view('admin.table', [
            'table' => $table,
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
        //
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
    public function destroy($id)
    {
        Company::find($id)->delete();
        return back();
    }
}
