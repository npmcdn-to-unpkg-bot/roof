<?php

namespace App\Http\Controllers\Admin\Catalog;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Catalog\Company;

class ReserveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $company = Company::find($id);
        $reserves = $company->reserves()->paginate(15);

        $th = [
            [
                'title'=>'Заголовок',
                'width'=>'auto',
            ],[
                'title'=>'Количество',
                'width'=>'auto',
            ],[
                'title'=>'Услуга оказана',
                'width'=>'100px',
            ]
        ];
        $table = collect()->push($th);
        foreach ($reserves as $reserve) {
            $table->push([
                [
                    'type'=>'text',
                    'field'=>$reserve->service->name,
                ],[
                    'type'=>'text',
                    'field'=>$company->level==3&&$reserve->service->group=='mailer' ? 'Не ограничено' : $reserve->count,
                ],[
                    'type'=>'html',
                    'html'=>$company->level==3&&$reserve->service->group=='mailer'?'':'<form action="'.route('admin.company.{company}.reserves.store',$company).'" method="POST">'.csrf_field().'<button class="btn btn-sm btn-info" data-toggle="tooltip" data-original-title="Услуга оказана"><input type="hidden" name="reserve_id" value="'.$reserve->id.'"><i class="glyphicon glyphicon-minus"></i></button></form>'
                ]
            ]);
        }

        return view('admin.catalog.index', [
            'table' => $table,
            'title' => 'Список зарезервированных услуг',
            'company' => $company,
            'pagination' => $reserves->render(),
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
    public function store(Request $request, $id)
    {
        $company = Company::find($id);
        $reserve = $company->reserves()->find($request->reserve_id);
        $reserve->count--;
        $reserve->save();
        if ($reserve->count <= 0) $reserve->delete();
        return back();
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
    }
}
