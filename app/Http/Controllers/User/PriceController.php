<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Storage;
use App\Models\Catalog\Price;
use App\Models\Catalog\Company;

class PriceController extends Controller
{

    protected function fields (Price $price) {

        return [
            [
                'name'=>'title',
                'type'=>'text',
                'placeholder'=>'Введите заголовок прайса',
                'label'=>'Заголовок',
                'value'=>old() ? old('title') : $price->title
            ],[
                'name' => 'name',
                'type' => 'file',
                'label' => 'Прайс',
                'value' => old() ? old('name') : $price->name
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
        $prices = auth()->user()->company->prices()->paginate(15);
        
        $th = [
            [
                'title'=>'Название',
                'width'=>'auto',
            ],[
                'title'=>'',
                'width'=>'90px',
            ]
        ];
        $table=collect()->push($th);
        foreach ($prices as $price) {
            $table->push([
                [
                    'type'=>'text',
                    'field'=>$price->title,
                ],[
                    'type'=>'actions',
                    'edit' => route('user.company.price.edit',$price),
                    'delete' => route('user.company.price.destroy',$price),
                ],
            ]);
        }

        return view('admin.universal.index', [
            'table' => $table,
            'items' => $prices,
            'title' => 'Прайсы',
            'pagination' => $prices->render()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $price = new Price;

        return view('admin.universal.edit',[
            'title' => 'Добавить прайс',
            'action' => route('user.company.price.store'),
            'fields' => $this->fields($price),
            'item' => $price
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
            $name = time().'-'
                .$request->file('upload')->getClientOriginalName();
            Storage::put(
                'prices/'.$name,
                file_get_contents($request->file('upload')->getRealPath())
            );
            $request->merge([
                'name' => $name,
                'type' => $request->file('upload')->getClientOriginalExtension()
            ]);
        }

        $validator = Price::validator($request->all());
        if ($validator->fails())
            return back()->withInput()->withErrors($validator);

        $price = auth()->user()->company->prices()->firstOrNew(['id' => $request->id]);
        $price->fill($request->only('title','name'));
        $price->type = $request->type ? $request->type : $price->type;
        $price->type = $price->type ? $price->type : 'zip';
        $price->save();

        return redirect()->route('user.company.price.index');
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
        $price = auth()->user()->company->prices()->find($id);

        return view('admin.universal.edit',[
            'title' => 'Редактировать вакансию',
            'action' => route('user.company.price.store'),
            'fields' => $this->fields($price),
            'item' => $price
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
        auth()->user()->company->prices()->find($id)->delete();
        return back();
    }
}
