<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Validator;
use Storage;
use App\Company;
use App\Sale;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SaleController extends Controller
{

    protected $table = [
        [
            'field'=>'image',
            'type'=>'image',
            'width'=>'40px',
            'title'=>'Картинка'
        ],[
            'field'=>'title',
            'type'=>'text',
            'width'=>'auto',
            'title'=>'Заголовок'
        ],[
            'field'=>'id',
            'type'=>'actions',
            'width'=>'90px',
            'title'=>''
        ],
    ];

    protected function fields (Sale $sale) {

        return [
            [
                'name'=>'title',
                'type'=>'text',
                'placeholder'=>'Введите заголовок',
                'label'=>'Заголовок',
                'value'=>old() ? old('title') : $sale->title
            ],[
                'name' => 'image',
                'type' => 'images',
                'label' => 'Картинка',
                'quantity' => 1,
                'values' => old() 
                    ? (array)old('image') 
                    : (array)$sale->image
            ],[
                'name'=>'entry',
                'type'=>'textarea',
                'placeholder'=>'Введите краткое содержание',
                'label'=>'Краткое содержание',
                'value'=>old() ? old('entry') : $sale->entry
            ],[
                'name'=>'content',
                'type'=>'ckeditor',
                'label'=>'Текст',
                'value'=>old() ? old('content') : $sale->content
            ],[
                'name'=>'sales',
                'type'=>'checkbox',
                'label'=>'Поместить новость в разделе "АКЦИИ И СКИДКИ"',
                'value'=>old() ? old('sales') : $sale->sales
            ],[
                'name'=>'company_id',
                'type'=>'select',
                'settings'=>'',
                'label'=>'Комания',
                'value'=>old() 
                    ? old('company_id') 
                    : ($sale->company ? $sale->company->id : ''),
                'options'=>Company::lists('name','id')
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

        $sales = Sale::paginate(15);

        return view('admin.table', [
            'table' => $this->table,
            'items' => $sales,
            'title' => 'Новости',
            'links' => [
                'show' => 'admin.sales.show',
                'edit' => 'admin.sales.edit',
                'delete' => 'admin.sales.destroy'
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
        $sale = new Sale;

        return view('admin.form',[
            'title' => 'Добавить акцию',
            'action' => 'admin.sales.store',
            'fields' => $this->fields($sale),
            'item' => $sale
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
        $validator = Validator::make($request->all(), Sale::$rules, Sale::$messages);
        if ($validator->fails())
            return back()->withInput()->withErrors($validator);

        $sale = Sale::firstOrNew(['id' => $request->id]);

        if (Storage::exists('temp/'.$request->image)) 
            Storage::move('temp/'.$request->image,'images/'.$request->image);
        if ($sale->image&&$sale->image!==$request->image) 
            Storage::delete('images/'.$sale->image);

        $sale
            ->fill($request->only('title','image','entry','content','sales','company_id'))
            ->save();

        return redirect()->route('admin.sales.index');
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

        $sale = Sale::with('company')->find($id);

        return view('admin.form',[
            'title' => 'Редактировать акцию',
            'action' => 'admin.sales.store',
            'fields' => $this->fields($sale),
            'item' => $sale
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
        Sale::find($id)->delete();
        return back();
    }
}
