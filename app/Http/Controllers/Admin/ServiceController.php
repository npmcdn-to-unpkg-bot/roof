<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Validator;
class ServiceController extends Controller
{

    protected function fields (Service $service) {

        return [
            [
                'name'=>'price',
                'type'=>'text',
                'placeholder'=>'Введите цену',
                'label'=>'Цена за "'.$service->name.'"',
                'value'=>old() ? old('price') : $service->price
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

        $services = Service::paginate(15);
        $th = [
                [
                    'title'=>'Название',
                    'width'=>'auto',
                ],[
                    'title'=>'Цена',
                    'width'=>'auto',
                ],[
                    'title'=>'',
                    'width'=>'90px',
                ],
        ];
        $table=collect()->push($th);
        foreach ($services as $service){
            $table->push([
                [
                    'field'=>$service->name,
                    'type'=>'text',
                ],[
                    'field'=>$service->price.'грн.',
                    'type'=>'text',
                ],[
                    'edit' => route('admin.services.edit', $service),
                    'delete' => false,
                    'type'=>'actions',
                ]
            ]);
        }

        return view('admin.universal.index', [
            'table' => $table,
            'items' => $services,
            'title' => 'Прайс на услуги',
            'pagination' => $services->render()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'price' => 'required|numeric'
        ],[
            'price.required' => 'Введите цену',
            'price.numeric' => 'Цена должна состоять только из цифр',
        ]);
        if ($validator->fails())
            return back()->withInput()->withErrors($validator);

        Service::where(['id'=>$request->id])->update(['price'=>$request->price]);

        return redirect()->route('admin.services.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $service = Service::find($id);

        return view('admin.universal.edit',[
            'title' => 'Редактировать цену',
            'action' => route('admin.services.store'),
            'fields' => $this->fields($service),
            'item' => $service
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
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort(404);
    }
}
