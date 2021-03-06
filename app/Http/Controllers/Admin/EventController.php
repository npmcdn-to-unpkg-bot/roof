<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Storage;
use App\Country;
use App\City;
use App\Event;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class EventController extends Controller
{

    protected function fields (Event $event) {
        return [
            [
                'name'=>'name',
                'type'=>'text',
                'placeholder'=>'Введите название события',
                'label'=>'Название события',
                'value'=>old() ? old('name') : $event->name
            ],[
                'name' => 'image',
                'type' => 'images',
                'label' => 'Картинка',
                'quantity' => 1,
                'values' => old() 
                    ? (array)old('image') 
                    : (array)$event->image
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
            ],[
                'type' => 'address',
                'label' => 'Адрес',
                'lat' => old() ? old('lat') : $event->lat,
                'lng' => old() ? old('lng') : $event->lng,
                'country' => old() 
                    ? Country::firstOrNew(['id'=>old('country_id')])
                    : ($event->city ? $event->city->country : Country::firstOrNew(['name'=>'Украина'])),
                'city' => old() 
                    ? City::firstOrNew(['id'=>old('city_id')])
                    : ($event->city ? $event->city : City::firstOrNew(['name'=>'Киев'])),
                'address' => old() 
                    ? old('address') 
                    : $event->address
            ],[
                'name'=>'meta_title',
                'type'=>'text',
                'label'=>'Введите meta title',
                'placeholder'=>'',
                'value'=>old() ? old('meta_title') : $event->meta_title
            ],[
                'name'=>'meta_description',
                'type'=>'textarea',
                'label'=>'Введите meta description',
                'placeholder'=>'',
                'value'=>old() ? old('meta_description') : $event->meta_description
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

        $events = Event::orderBy('created_at','DESC')->paginate(15);
        $th = [
            [
                'title'=>'Картинка',
                'width'=>'40px',
            ],[
                'title'=>'Название',
                'width'=>'auto',
            ],[
                'title'=>'Начало',
                'width'=>'auto',
            ],[
                'title'=>'Конец',
                'width'=>'auto',
            ],[
                'title'=>'',
                'width'=>'90px',
            ],
        ];
        $table=collect()->push($th);
        foreach ($events as $event){
            $table->push([
                [
                    'field'=>$event->image,
                    'type'=>'image',
                ],[
                    'field'=>$event->name,
                    'type'=>'text',
                ],[
                    'field'=>$event->start,
                    'type'=>'date',
                ],[
                    'field'=>$event->end,
                    'type'=>'date',
                ],[
                    'edit' => route('admin.events.edit', $event),
                    'delete' => route('admin.events.destroy', $event),
                    'type'=>'actions',
                ],
            ]);
        }
        return view('admin.universal.index', [
            'table' => $table,
            'items' => $events,
            'title' => 'События',
            'pagination' => $events->render()
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

        return view('admin.universal.edit',[
            'title' => 'Добавить событие',
            'action' => route('admin.events.store'),
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
        $validator = Event::validator($request->all());
        if ($validator->fails()) 
            return back()->withInput()->withErrors($validator);

        $request->merge([
            'start' => Carbon::parse($request->start),
            'end' => Carbon::parse($request->end),
        ]);
        
        $event = Event::firstOrNew(['id' => $request->id]);

        if (Storage::exists('temp/'.$request->image)&&!Storage::exists('images/'.$request->image)) 
            Storage::move('temp/'.$request->image,'images/'.$request->image);
        
        if ($event->image&&$event->image!==$request->image) 
            Storage::delete('images/'.$event->image);

        $event
            ->fill($request->only('name','image','information','start','end','founder','address','lat','lng','city_id','website','meta_title','meta_description'))
            ->save();

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

        return view('admin.universal.edit',[
            'title' => 'Редактировать событие',
            'action' => route('admin.events.store'),
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
