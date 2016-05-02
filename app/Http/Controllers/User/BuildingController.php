<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use Storage;
use Auth;
use Illuminate\Http\Request;
use App\Models\Building\Building;
use App\Country;
use App\City;
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
                'type' => 'images',
                'label' => 'Фотографии',
                'quantity' => 5,
                'values' => old() 
                    ? (array)old('images') 
                    : $building->images()->lists('name')
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
            ],[
                'type' => 'address',
                'label' => 'Адрес',
                'lat' => old() ? old('lat') : $building->lat,
                'lng' => old() ? old('lng') : $building->lng,
                'country' => old() 
                    ? Country::firstOrNew(['id'=>old('country_id')])
                    : ($building->city ? $building->city->country : new Country),
                'city' => old() 
                    ? City::firstOrNew(['id'=>old('city_id')])
                    : ($building->city ? $building->city : new Country),
                'address' => old() 
                    ? old('address') 
                    : $building->address
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

        $buildings = Auth::user()->company->buildings()->orderBy('created_at', 'DESC')->paginate(15);        

        $th = [
                [
                    'title'=>'Название стройки',
                    'width'=>'auto',
                ],[
                    'title'=>'Тип строения',
                    'width'=>'auto',
                ],[
                    'title'=>'',
                    'width'=>'90px',
                ],
        ];
        $table=collect()->push($th);
        foreach ($buildings as $building){
            $table->push([
                [
                    'field'=>$building->name,
                    'type'=>'text',
                ],[
                    'field'=>$building->type,
                    'type'=>'text',
                ],[
                    'edit' => route('user.buildings.edit', $building),
                    'delete' => route('user.buildings.destroy', $building),
                    'type'=>'actions',
                ],
            ]);
        }
        return view('admin.universal.index', [
            'table' => $table,
            'items' => $buildings,
            'title' => 'Стройки',
            'pagination' => $buildings->render()
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

        return view('admin.universal.edit',[
            'title' => 'Добавить компанию',
            'action' => route('user.buildings.store'),
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

        $validator = Building::validator($request->all());
        if ($validator->fails())
            return back()->withInput()->withErrors($validator);

        $request->merge([
            'start' => Carbon::createFromFormat('m Y', $request->start),
            'end' => Carbon::createFromFormat('m Y', $request->end),
        ]);

        $building = Auth::user()
            ->company
            ->buildings()
            ->firstOrNew(['id' => $request->id]);
        $building
            ->fill($request->only('name','type','information','published','start','end','lat','lng','address','city_id'))
            ->save();

        $oldimages = $building
            ->images()
            ->whereNotIn('name', $request->images)
            ->get();
        foreach ($oldimages as $image) {
            Storage::delete('images/'.$image->name);
            $image->delete();
        }
        $images=collect();
        foreach ($request->images as $order => $name) {
            if ( Storage::exists('temp/'.$name) ) 
                Storage::move('temp/'.$name,'images/'.$name);
            $image = Image::firstOrNew(['name'=>$name]);
            $image
                ->fill(['order'=>$order])
                ->save();
            $images->push($image);
        }

        $building->images()->sync($images->pluck('id')->all());

        return redirect()->route('user.buildings.index');
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
        $building = Auth::user()->company->buildings()->where('id', $id)->first();

        if (!$building) return redirect()->route('user.buildings.create');

        return view('admin.universal.edit',[
            'title' => 'Добавить компанию',
            'action' => route('user.buildings.store'),
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
        Auth::user()->company->buildings()->where('id', $id)->delete();
        return back();
    }
}
