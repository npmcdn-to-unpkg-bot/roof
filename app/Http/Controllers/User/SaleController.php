<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Validator;
use Storage;
use Auth;
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

        $sales = Auth::user()->company->sales()->paginate(15);

        return view('admin.table', [
            'table' => $this->table,
            'items' => $sales,
            'title' => 'Новости',
            'links' => [
                'show' => 'user.sales.show',
                'edit' => 'user.sales.edit',
                'delete' => 'user.sales.destroy'
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
            'action' => 'user.sales.store',
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

        
        $sale = Auth::user()
            ->company
            ->sales()
            ->firstOrNew(['id' => $request->id]);

        if (Storage::exists('temp/'.$request->image)) 
            Storage::move('temp/'.$request->image,'images/'.$request->image);
        if ($sale->image&&$sale->image!==$request->image) 
            Storage::delete('images/'.$sale->image);

        $sale
            ->fill($request->only('title','image','entry','content'))
            ->save();

        return redirect()->route('user.sales.index');
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
        $company = Auth::user()->company;
        $sale = $company->sales()->where('id',$id)->first();
        if (!$sale) return redirect()->route('user.sales.create');

        return view('admin.form',[
            'title' => 'Редактировать акцию',
            'action' => 'user.sales.store',
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
        Auth::user()->company->sales()->where('id',$id)->delete();
        return back();
    }
}
