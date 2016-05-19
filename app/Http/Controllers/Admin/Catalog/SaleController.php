<?php

namespace App\Http\Controllers\Admin\Catalog;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Storage;
use App\Models\Catalog\Sale;
use App\Models\Catalog\Company;

class SaleController extends Controller
{

    protected function fields (Sale $sale) {

        return [
            [
                'name'=>'title',
                'type'=>'text',
                'placeholder'=>'Введите заголовок акции',
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
                'placeholder'=>'Введите краткое содержание акции',
                'label'=>'Краткое содержание',
                'value'=>old() ? old('entry') : $sale->entry
            ],[
                'name'=>'content',
                'type'=>'ckeditor',
                'label'=>'Текст акции',
                'value'=>old() ? old('content') : $sale->content
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
    public function index($company)
    {
        $sales = Company::find($company)->sales()->paginate(15);
        $company = Company::find($company);
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
            ]
        ];
        $table=collect()->push($th);
        foreach ($sales as $sale) {
            $table->push([
                [
                    'type'=>'image',
                    'field'=>$sale->image,
                ],[
                    'type'=>'text',
                    'field'=>$sale->title,
                ],[
                    'type'=>'actions',
                    'edit' => route('admin.company.{company}.sales.edit',['company'=>$company,'sales'=>$sales]),
                    'delete' => route('admin.company.{company}.sales.destroy',['company'=>$company,'sales'=>$sales]),
                ],
            ]);
        }

        return view('admin.catalog.index', [
            'table' => $table,
            'title' => 'Акции',
            'company' => $company,
            'add' => route('admin.company.{company}.sales.create',$company),
            'pagination' => $sales->render()
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($company)
    {
        $sale = new Sale(['company_id'=>$company]);
        $company = Company::find($company);

        return view('admin.catalog.edit',[
            'title' => 'Добавить акцию',
            'action' => route('admin.company.{company}.sales.store',$company),
            'company' => $company,
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
    public function store(Request $request, $company)
    {
        $validator = Sale::validator($request->all());
        if ($validator->fails())
            return back()->withInput()->withErrors($validator);

        $sale = Sale::firstOrNew(['id' => $request->id]);

        if (Storage::exists('temp/'.$request->image)) 
            Storage::move('temp/'.$request->image,'images/'.$request->image);
        if ($sale->image&&$sale->image!==$request->image) 
            Storage::delete('images/'.$company->image);

        $sale->fill($request->only('title','image','entry','content','company_id'));
        $sale->save();

        return redirect()->route('admin.company.{company}.sales.index', $company);
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
        $sale = Sale::find($id);
        $company = Company::find($company);

        return view('admin.universal.edit',[
            'title' => 'Редактировать акцию',
            'action' => route('admin.company.{company}.sales.store',$company),
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
    public function destroy($company, $id)
    {
        Sale::find($id)->delete();
        return back();
    }
}
