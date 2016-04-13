<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Validator;
use Image;
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

    protected $fields = [
        [
            'name'=>'title',
            'type'=>'text',
            'placeholder'=>'Введите заголовок',
            'label'=>'Заголовок'
        ],[
            'name'=>'image',
            'type'=>'image',
            'label'=>'Картинка'
        ],[
            'name'=>'entry',
            'type'=>'textarea',
            'placeholder'=>'Введите краткое содержание',
            'label'=>'Краткое содержание'
        ],[
            'name'=>'content',
            'type'=>'ckeditor',
            'label'=>'Текст статьи'
        ]
    ];
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

        return view('admin.form',[
            'title' => 'Добавить новость',
            'action' => 'admin.sales.store',
            'fields' => $this->fields,
            'item' => new Sale
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
            $image = time().'-'
                .$request->file('upload')->getClientOriginalName();
            Image::make($request
                ->file('upload'))
                ->fit(1600, 1024, function ($constraint) { $constraint->upsize(); })
                ->save(storage_path('app/images/').$image);
            $request->merge(['image' => $image]);
        }

        $validator = Validator::make($request->all(), Sale::$rules, Sale::$messages);

        if ($validator->fails())
            return back()->withInput()->withErrors($validator);

        Sale::firstOrNew(['id' => $request->id])
            ->fill($request->only('title','image','entry','content','market'))
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
        return view('admin.form',[
            'title' => 'Редактировать новость',
            'action' => 'admin.sales.store',
            'fields' => $this->fields,
            'item' => Sale::find($id)
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
