<?php

namespace App\Http\Controllers\User;

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
        $examples = auth()->user()->company->examples()->paginate(15);
        
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
                    'edit' => route('user.company.examples.edit',$example),
                    'delete' => route('user.company.examples.destroy',$example),
                ],
            ]);
        }

        return view('admin.universal.index', [
            'table' => $table,
            'title' => 'Портфолио',
            'add' => route('user.company.examples.create'),
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
        $example = new Example();
        return view('admin.universal.edit',[
            'title' => 'Добавить пример в портфолио',
            'action' => route('user.company.examples.store'),
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
    public function store(Request $request)
    {
        $validator = Example::validator($request->all());
        if ($validator->fails())
            return back()->withInput()->withErrors($validator);

        $example = auth()->user()->company->examples()->firstOrNew(['id' => $request->id]);

        if (Storage::exists('temp/'.$request->image)) 
            Storage::move('temp/'.$request->image,'images/'.$request->image);
        if ($example->image&&$example->image!==$request->image) 
            Storage::delete('images/'.$company->image);

        $example->fill($request->only('title','image','content'));
        $example->save();

        return redirect()->route('user.company.examples.index');
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
        $example = auth()->user()->company->examples()->find($id);
        return view('admin.universal.edit',[
            'title' => 'Редактировать пример в портфолио',
            'action' => route('user.company.examples.store'),
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
    public function destroy($id)
    {
        auth()->user()->company->examples()->find($id)->delete();
        return back();
    }
}
