<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Validator;
use Storage;
use App\Models\Catalog\Company;
use App\Sale;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SaleController extends Controller
{

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
                'name'=>'meta_title',
                'type'=>'text',
                'label'=>'Введите meta title',
                'placeholder'=>'',
                'value'=>old() ? old('meta_title') : $sale->meta_title
            ],[
                'name'=>'meta_description',
                'type'=>'textarea',
                'label'=>'Введите meta description',
                'placeholder'=>'',
                'value'=>old() ? old('meta_description') : $sale->meta_description
            ],[
                'name' => 'start',
                'type' => 'datepicker',
                'format' => 'DD.MM.YYYY HH:mm',
                'label' => 'Начало',
                'value' => old() ? old('start') : ($sale->start > Carbon::parse('1975') ? $sale->start->format('d.m.Y H:i') : '')
            ],[
                'name' => 'end',
                'type' => 'datepicker',
                'format' => 'DD.MM.YYYY HH:mm',
                'label' => 'Конец',
                'value' => old() ? old('end') : ($sale->end > Carbon::parse('1975') ? $sale->end->format('d.m.Y H:i') : '')
            ],[
                'name'=>'company_id',
                'type'=>'select',
                'settings'=>'',
                'label'=>'Компания',
                'value'=>old() 
                    ? old('company_id') 
                    : ($sale->company ? $sale->company->id : ''),
                'options'=>Company::lists('name','id')
            ],
        ];

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $sales = Sale::orderBy('created_at','DESC')->paginate(15);
        $th = [
            [
                'title'=>'Картинка',
                'width'=>'40px',
            ],[
                'title'=>'Заголовок',
                'width'=>'auto',
            ],[
                'title'=>'',
                'width'=>'90px',
            ],
        ];
        $table=collect()->push($th);
        foreach ($sales as $sale){
            $table->push([
                [
                    'field'=>$sale->image,
                    'type'=>'image',
                ],[
                    'field'=>$sale->title,
                    'type'=>'text',
                ],[
                    'edit' => route('admin.sales.edit', $sale),
                    'delete' => route('admin.sales.destroy', $sale),
                    'type'=>'actions',
                ],
            ]);
        }
        return view('admin.universal.index', [
            'table' => $table,
            'items' => $sales,
            'title' => 'Акции и скидки',
            'pagination' => $sales->render()
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

        return view('admin.universal.edit',[
            'title' => 'Добавить акцию',
            'action' => route('admin.sales.store'),
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

        if ($request->end)
            $request->merge(['end' => Carbon::parse($request->end)]);
        if ($request->start)
            $request->merge(['start' => Carbon::parse($request->start)]);

        $sale = Sale::firstOrNew(['id' => $request->id]);

        if (Storage::exists('temp/'.$request->image)&&!Storage::exists('images/'.$request->image)) 
            Storage::move('temp/'.$request->image,'images/'.$request->image);

        if ($sale->image&&$sale->image!==$request->image) 
            Storage::delete('images/'.$sale->image);


        $sale
            ->fill($request->only('title','image','entry','content','meta_title','meta_description','end','start','company_id'))
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

        return view('admin.universal.edit',[
            'title' => 'Редактировать акцию',
            'action' => route('admin.sales.store'),
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
