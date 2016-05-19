<?php

namespace App\Http\Controllers\Admin\Catalog;

use Illuminate\Http\Request;

use Storage;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Catalog\Example;
use App\Models\Catalog\Company;

class ExampleController extends Controller
{

    protected function fields (Example $example) {

        return [
            [
                'name'=>'title',
                'type'=>'text',
                'placeholder'=>'Введите название примера работы.',
                'label'=>'Название примера работы',
                'value'=>old() ? old('title') : $example->title
            ],[
                'name' => 'image',
                'type' => 'images',
                'label' => 'Картинка',
                'quantity' => 1,
                'values' => old() 
                    ? (array)old('image') 
                    : (array)$example->image
            ],[
                'name'=>'content',
                'type'=>'ckeditor',
                'label'=>'Описание',
                'value'=>old() ? old('content') : $example->content
            ],[
                'name'=>'company_id',
                'type'=>'select',
                'settings'=>'',
                'label'=>'Комания',
                'value'=>old() 
                    ? old('company_id') 
                    : ($example->company ? $example->company->id : ''),
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
        $examples = Company::find($company)->examples()->paginate(15);
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
        foreach ($examples as $example) {
            $table->push([
                [
                    'type'=>'image',
                    'field'=>$example->image,
                ],[
                    'type'=>'text',
                    'field'=>$example->title,
                ],[
                    'type'=>'actions',
                    'edit' => route('admin.company.{company}.examples.edit',['company'=>$company,'examples'=>$examples]),
                    'delete' => route('admin.company.{company}.examples.destroy',['company'=>$company,'examples'=>$examples]),
                ],
            ]);
        }

        return view('admin.catalog.index', [
            'table' => $table,
            'title' => 'Портфолио',
            'company' => $company,
            'add' => route('admin.company.{company}.examples.create',$company),
            'pagination' => $examples->render()
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($company)
    {
        $example = new Example(['company_id'=>$company]);
        $company = Company::find($company);
        return view('admin.catalog.edit',[
            'title' => 'Добавить пример в портфолио',
            'action' => route('admin.company.{company}.examples.store',$company),
            'company' => $company,
            'fields' => $this->fields($example),
            'item' => $example
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
        $validator = Example::validator($request->all());
        if ($validator->fails())
            return back()->withInput()->withErrors($validator);

        $example = Example::firstOrNew(['id' => $request->id]);

        if (Storage::exists('temp/'.$request->image)) 
            Storage::move('temp/'.$request->image,'images/'.$request->image);
        if ($example->image&&$example->image!==$request->image) 
            Storage::delete('images/'.$company->image);

        $example->fill($request->only('title','image','content','company_id'));
        $example->save();

        return redirect()->route('admin.company.{company}.examples.index', $company);
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
        $example = Example::find($id);
        $company = Company::find($company);
        return view('admin.catalog.edit',[
            'title' => 'Редактировать пример в портфолио',
            'action' => route('admin.company.{company}.examples.store',$company),
            'company' => $company,
            'fields' => $this->fields($example),
            'item' => $example
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
        Example::find($id)->delete();
        return back();
    }
}
