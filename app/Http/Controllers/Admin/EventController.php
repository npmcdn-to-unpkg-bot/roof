<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Image;
use App\Event;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class EventController extends Controller
{

    protected $table = [
        [
            'field'=>'image',
            'type'=>'image',
            'width'=>'40px',
            'title'=>'Картинка'
        ],[
            'field'=>'name',
            'type'=>'text',
            'width'=>'auto',
            'title'=>'Название'
        ],[
            'field'=>'start',
            'type'=>'date',
            'width'=>'auto',
            'title'=>'Начало'
        ],[
            'field'=>'end',
            'type'=>'date',
            'width'=>'auto',
            'title'=>'Конец'
        ],[
            'field'=>'id',
            'type'=>'actions',
            'width'=>'90px',
            'title'=>''
        ],
    ];

    protected function fields (Event $event) {
        return [
            [
                'name'=>'name',
                'type'=>'text',
                'placeholder'=>'Введите название события',
                'label'=>'Название события',
                'value'=>old() ? old('name') : $event->name
            ],[
                'name'=>'image',
                'type'=>'image',
                'label'=>'Картинка',
                'value'=>old() ? old('image') : $event->image
            ],[
                'name'=>'information',
                'type'=>'ckeditor',
                'label'=>'Информация',
                'value'=>old() ? old('information') : $event->information
            ],[
                'name'=>'founder',
                'type'=>'text',
                'placeholder'=>'Введите название органиации',
                'label'=>'Организатор',
                'value'=>old() ? old('founder') : $event->founder
            ],[
                'name'=>'website',
                'type'=>'text',
                'placeholder'=>'Введите ссылку на вебсайт',
                'label'=>'Сайт события',
                'value'=>old() ? old('website') : $event->website
            ],[
                'name'=>'address',
                'type'=>'text',
                'placeholder'=>'Введите адрес события',
                'label'=>'Место события',
                'value'=>old() ? old('address') : $event->address
            ],[
                'name' => 'start',
                'type' => 'datepicker',
                'format' => 'DD.MM.YYYY',
                'label' => 'Дата начала',
                'value' => old() ? old('start') : $event->start->format('d.m.Y')
            ],[
                'name' => 'end',
                'type' => 'datepicker',
                'format' => 'DD.MM.YYYY',
                'label' => 'Дата окончания',
                'value' => old() ? old('end') : $event->end->format('d.m.Y')
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

        $events = Event::paginate(15);

        return view('admin.table', [
            'table' => $this->table,
            'items' => $events,
            'title' => 'События',
            'links' => [
                'show' => 'admin.events.show',
                'edit' => 'admin.events.edit',
                'delete' => 'admin.events.destroy'
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
        $event = new Event([
            'start'=>date("Y-m-d H:i:s"),
            'end'=>date("Y-m-d H:i:s"),
        ]);

        return view('admin.form',[
            'title' => 'Добавить событие',
            'action' => 'admin.events.store',
            'fields' => $this->fields($event),
            'item' => $event
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

        $validator = Event::validator($request->all());
        if ($validator->fails()) 
            return back()->withInput()->withErrors($validator);

        $request->merge([
            'start' => Carbon::parse($request->start),
            'end' => Carbon::parse($request->end),
        ]);

        $event = Event::firstOrNew(['id' => $request->id])
            ->fill($request->only('name','image','information','start','end','founder','address','website'));
        $event->save();

        return redirect()->route('admin.events.index');

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
        $event = Event::find($id);

        return view('admin.form',[
            'title' => 'Редактировать событие',
            'action' => 'admin.events.store',
            'fields' => $this->fields($event),
            'item' => $event
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
        Event::find($id)->delete();
        return redirect()->route('admin.events.index');
    }
}
