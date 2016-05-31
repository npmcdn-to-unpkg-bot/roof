<?php

namespace App\Http\Controllers\User\Services;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ReserveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reserves = auth()->user()->reserves()->paginate(15);

        $th = [
            [
                'title'=>'Заголовок',
                'width'=>'auto',
            ],[
                'title'=>'Количество',
                'width'=>'auto',
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
                    'field'=>$reserve->count,
                ]
            ]);
        }

        return view('admin.universal.index', [
            'title' => 'Список зарезервированных услуги',
            'table' => $table,
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
    }
}
