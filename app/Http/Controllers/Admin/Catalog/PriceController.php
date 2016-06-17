<?php

namespace App\Http\Controllers\Admin\Catalog;

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
                'placeholder'=>'Введите заголовок статьи',
                'label'=>'Заголовок',
                'value'=>old() ? old('title') : $price->title
            ],[
                'name' => 'name',
                'type' => 'file',
                'label' => 'Прайс',
                'value' => old() ? old('name') : $price->name
            ],[
                'name'=>'company_id',
                'type'=>'select',
                'settings'=>'',
                'label'=>'Компания',
                'value'=>old() 
                    ? old('company_id') 
                    : ($price->company ? $price->company->id : ''),
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
        $prices = Company::find($company)->prices()->paginate(15);
        $company = Company::find($company);
        
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
                    'edit' => route('admin.company.{company}.prices.edit',['company'=>$company,'prices'=>$price]),
                    'delete' => route('admin.company.{company}.prices.destroy',['company'=>$company,'prices'=>$price]),
                ],
            ]);
        }

        return view('admin.catalog.index', [
            'table' => $table,
            'title' => 'Прайсы',
            'company' => $company,
            'add' => route('admin.company.{company}.prices.create',$company),
            'pagination' => $prices->render()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($company)
    {
        $price = new Price(['company_id'=>$company]);
        $company = Company::find($company);

        return view('admin.catalog.edit',[
            'title' => 'Добавить прайс',
            'action' => route('admin.company.{company}.prices.store',$company),
            'company' => $company,
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
    public function store(Request $request, $company)
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

        $price = Price::firstOrNew(['id' => $request->id]);
        $price->fill($request->only('title','name','company_id'));
        $price->type = $request->type ? $request->type : $price->type;
        $price->type = $price->type ? $price->type : 'zip';
        $price->save();

        return redirect()->route('admin.company.{company}.prices.index', $company);
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
        $price = Price::find($id);
        $company = Company::find($company);

        return view('admin.catalog.edit',[
            'title' => 'Добавить прайс',
            'action' => route('admin.company.{company}.prices.store',$company),
            'company' => $company,
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
    public function destroy($company, $id)
    {
        Price::find($id)->delete();
        return back();
    }
}
