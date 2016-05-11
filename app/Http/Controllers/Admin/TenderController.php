<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Tender;
use App\Models\Catalog\Company;
use Storage;
use Carbon\Carbon;

class TenderController extends Controller
{

    protected function fields (Tender $tender) {
        $companies = Company::lists('name','id')->put($tender->company_name, $tender->company_name);
        if (old()&&!Company::find(old('company'))&&old('company')!=0) {
            $companies->put(old('company'), old('company'));
        }
        return [
            [
                'name'=>'name',
                'type'=>'text',
                'placeholder'=>'Введите название тендера',
                'label'=>'Название',
                'value'=>old() ? old('name') : $tender->name
            ],[
                'name'=>'budget',
                'type'=>'price',
                'placeholder'=>'Введите бюджет тендера',
                'label'=>'Бюджет',
                'value'=>old() ? old('budget') : $tender->budget
            ],[
                'name'=>'person',
                'type'=>'text',
                'placeholder'=>'Введите имя',
                'label'=>'Контактное лицо',
                'value'=>old() ? old('person') : $tender->person
            ],[
                'name'=>'email',
                'type'=>'text',
                'placeholder'=>'Введите email',
                'label'=>'Email',
                'value'=>old() ? old('email') : $tender->email
            ],[
                'name'=>'phone',
                'type'=>'text',
                'placeholder'=>'Введите телефон',
                'label'=>'Телефон',
                'value'=>old() ? old('phone') : $tender->phone
            ],[
                'name' => 'end',
                'type' => 'datepicker',
                'format' => 'DD.MM.YYYY',
                'label' => 'Дата окончания приема заявок',
                'value' => old() ? old('end') : $tender->end->format('d.m.Y')
            ],[
                'name' => 'image',
                'type' => 'images',
                'label' => 'Картинка',
                'quantity' => 1,
                'values' => old() 
                    ? (array)old('image') 
                    : (array)$tender->image
            ],[
                'name'=>'description',
                'type'=>'ckeditor',
                'label'=>'Описание тендера',
                'value'=>old() ? old('description') : $tender->description
            ],[
                'name'=>'company',
                'type'=>'select',
                'label'=>'Комания',
                'settings' => 'tags: true,',
                'value'=>old() 
                    ? old('company') 
                    : ($tender->company ? $tender->company->id : $tender->company_name),
                'options'=>$companies
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

        $tenders = Tender::paginate(15);
        $th = [
                [
                    'title'=>'Название',
                    'width'=>'auto',
                ],[
                    'title'=>'Бюджет',
                    'width'=>'auto',
                ],[
                    'title'=>'Дата окончания',
                    'width'=>'auto',
                ],[
                    'title'=>'',
                    'width'=>'90px',
                ],
        ];
        $table=collect()->push($th);
        foreach ($tenders as $tender){
            $table->push([
                [
                    'field'=>$tender->name,
                    'type'=>'text',
                ],[
                    'field'=>$tender->budget,
                    'type'=>'text',
                ],[
                    'field'=>$tender->end,
                    'type'=>'date',
                ],[
                    'edit' => route('admin.tenders.edit', $tender),
                    'delete' => route('admin.tenders.destroy', $tender),
                    'type'=>'actions',
                ],
            ]);
        }

        return view('admin.universal.index', [
            'table' => $table,
            'items' => $tenders,
            'title' => 'Тендеры',
            'pagination' => $tenders->render()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $tender = new Tender(['end'=>date("Y-m-d H:i:s")]);

        return view('admin.universal.edit',[
            'title' => 'Добавить тендер',
            'action' => route('admin.tenders.store'),
            'fields' => $this->fields($tender),
            'item' => $tender
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
        $validator = Tender::validator($request->all());
        if ($validator->fails())
            return back()->withInput()->withErrors($validator);

        $request->merge(['end' => Carbon::parse($request->end)]);

        $tender = Tender::firstOrNew(['id' => $request->id]);

        if (Company::find($request->company)) {
            $tender->company_id = $request->company;
            $tender->company_name = '';
        } else {
            $tender->company_id = 0;
            $tender->company_name = $request->company;
        }

        if ($request->image&&Storage::exists('temp/'.$request->image)) 
            Storage::move('temp/'.$request->image,'images/'.$request->image);

        if ($tender->image&&$tender->image!==$request->image) 
            Storage::delete('images/'.$tender->image);

        $tender->fill($request->only('name','description','budget','image','end','person','email','phone'));
        $tender->save();

        return redirect()->route('admin.tenders.index');
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

        $tender = Tender::find($id);

        return view('admin.universal.edit',[
            'title' => 'Редактировать тендер',
            'action' => route('admin.tenders.store'),
            'fields' => $this->fields($tender),
            'item' => $tender
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
        Tender::find($id)->delete();

        return back();
    }
}
