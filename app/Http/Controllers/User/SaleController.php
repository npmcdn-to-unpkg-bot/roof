<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Validator;
use Storage;
use Auth;
use App\Models\Catalog\Company;
use App\Sale;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

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

        $sales = Auth::user()->company->sales()->paginate(15);

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
        $table = collect()->push($th);
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
                    'edit' => route('user.company.sales.edit',$sale),
                    'delete' => route('user.company.sales.destroy',$sale),
                ]
            ]);
        }

        return view('admin.universal.index', [
            'title' => 'Акции и скидки',
            'table' => $table,
            'pagination' => $sales->render(),
            'add' => route('user.company.sales.create')
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
            'action' => route('user.company.sales.store'),
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
        
        $sale = Auth::user()
            ->company
            ->sales()
            ->firstOrNew(['id' => $request->id]);

        if (Storage::exists('temp/'.$request->image)&&!Storage::exists('images/'.$request->image)) 
            Storage::move('temp/'.$request->image,'images/'.$request->image);
        
        if ($sale->image&&$sale->image!==$request->image) 
            Storage::delete('images/'.$sale->image);

        $sale
            ->fill($request->only('title','image','entry','content','start','end'))
            ->save();

        return redirect()->route('user.company.sales.index');
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
        if (!$sale) return redirect()->route('user.company.sales.create');

        return view('admin.universal.edit',[
            'title' => 'Редактировать акцию',
            'action' => route('user.company.sales.store'),
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
