<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Validator;
use Storage;
use Illuminate\Http\Request;
use App\Building;
use App\Image;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BuildingController extends Controller
{
    protected $table = [
        [
            'field'=>'name',
            'type'=>'text',
            'width'=>'auto',
            'title'=>'Название стройки'
        ],[
            'field'=>'type',
            'type'=>'text',
            'width'=>'auto',
            'title'=>'Тип строения'
        ],[
            'field'=>'id',
            'type'=>'actions',
            'width'=>'90px',
            'title'=>''
        ],
    ];

    public function fields (Building $building) {
        return [
            [
                'name' => 'name',
                'type' => 'text',
                'placeholder' => 'Введите название объекта',
                'label' => 'Название объекта',
                'value' => old() ? old('name') : $building->name
            ],[
                'name' => 'images',
                'type' => 'gallery',
                'label' => 'Фотографии',
                'quantity' => 5,
                'values' => old() 
                    ? old('images') 
                    : $building->images->map(function($image){return $image->image;})->all()
            ],[
                'name' => 'type',
                'type' => 'text',
                'placeholder' => 'Введите тип объекта',
                'label' => 'Тип объекта',
                'value' => old() ? old('type') : $building->type
            ],[
                'name' => 'information',
                'type' => 'textarea',
                'placeholder' => 'Введите информацию об объекте',
                'label' => 'Информация об объекте',
                'value' => old() ? old('information') : $building->information
            ],[
                'name' => 'published',
                'type' => 'checkbox',
                'label' => 'Опубликовать в разделе СТРОЙКИ И ВАКАНСИИ',
                'value' => old() ? old('published') : $building->published
            ],[
                'name' => 'start',
                'type' => 'datepicker',
                'format' => 'MM YYYY',
                'label' => 'Дата начала',
                'value' => old() ? old('start') : $building->start->format('m Y')
            ],[
                'name' => 'end',
                'type' => 'datepicker',
                'format' => 'MM YYYY',
                'label' => 'Дата окончания',
                'value' => old() ? old('end') : $building->end->format('m Y')
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

        $buildings = Building::orderBy('created_at', 'DESC')->paginate(15);        

        return view('admin.table', [
            'table' => $this->table,
            'items' => $buildings,
            'title' => 'Стройки',
            'links' => [
                'show' => 'admin.building.show',
                'edit' => 'admin.building.edit',
                'delete' => 'admin.building.destroy'
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
        $building = new Building([
            'start'=>date("Y-m-d H:i:s"),
            'end'=>date("Y-m-d H:i:s"),
        ]);

        return view('admin.form',[
            'title' => 'Добавить компанию',
            'action' => 'admin.building.store',
            'fields' => $this->fields($building),
            'item' => $building
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

        $validator = Validator::make($request->all(), Building::$rules, Building::$messages);
        if ($validator->fails())
            return back()->withInput()->withErrors($validator);

        $request->merge([
            'start' => Carbon::createFromFormat('m Y', $request->start),
            'end' => Carbon::createFromFormat('m Y', $request->end),
        ]);


        $building = Building::firstOrNew(['id' => $request->id])
            ->fill($request->only('name','type','information','published','start','end'));
        $building->save();

        $building->images()->whereNotIn('image', $request->images)->delete();
        $images=collect();
        foreach ($request->images as $image) {
            if ( Storage::exists('temp/'.$image) ) 
                Storage::move('temp/'.$image,'images/'.$image);
            $images->push(Image::firstOrCreate(['image'=>$image]));
        }

        $building->images()->sync($images->map(function($image){return $image->id;})->all());

        return redirect()->route('admin.building.index');
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
        $building = Building::find($id);

        return view('admin.form',[
            'title' => 'Добавить компанию',
            'action' => 'admin.building.store',
            'fields' => $this->fields($building),
            'item' => $building
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
        Building::find($id)->delete();
        return back();
    }
}
