<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = auth()->user()->company->new_members;
        $members = $members->merge( auth()->user()->company->members );

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
                    'width'=>'50px',
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
                    'html'=>$member->join_company_id ? '<a class="btn btn-sm btn-success" href="/user/company/staff/'.$member->id.'/accept" data-toggle="tooltip" data-original-title="Подтвердить"><i class="fa fa-check"></id></a>' : '',
                    'type'=>'html',
                ],[
                    'edit' => false,
                    'delete' => route('user.company.staff.destroy', $member),
                    'type'=>'actions',
                ],
            ]);
        }
        return view('admin.universal.index', [
            'table' => $table,
            'items' => $members,
            'title' => 'Сотрудники компании',
            'pagination' => false,
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
        auth()->user()->company->new_members()->where('id',$id)->update([
            'join_company_id' => 0
        ]);
        auth()->user()->company->members()->where('id',$id)->update([
            'company_id' => 0
        ]);
        return back();
    }
    
    public function accept($id)
    {
        auth()->user()->company->new_members()->where('id',$id)->update([
            'join_company_id' => 0,
            'company_id' => auth()->user()->company->id
        ]);
        return back();
    }

}
