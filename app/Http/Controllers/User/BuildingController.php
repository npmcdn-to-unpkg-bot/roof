<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use App\Image;
use Storage;
use App\Building;
use Auth;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.building.index', [
           'buildings' => Auth::user()->company->buildings
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.building.form', [
            'title' => 'Добавить стройку',
            'building' => new Building
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
        $validator = Validator::make($request->all(),[
                'name' => 'required|min:3|max:33',
                'type' => 'required|min:3|max:33',
                'images' => 'required',
                'information' => 'required|min:50|max:1024'
            ],[
                'name.required' => 'Введите название объекта',
                'name.max' => 'Название должно быть не больше 33 символов',
                'name.min' => 'Название должно быть не меньше 3 символов',
                'type.required' => 'Введите тип обхекта',
                'type.max' => 'Тип объекта должен быть не больше 33 символов',
                'type.min' => 'Тип объекта должен быть не меньше 3 символов',
                'images.required' => 'Загрузите изображения',
                'information.required' => 'Введите инофрмация об объекте',
                'information.min' => 'Описание должно быть не менее 50 символов',
                'information.max' => 'Описание должно быть не более 255 символов'
            ]);
        
        if ($validator->fails())
            return back()
                ->withInput()
                ->withErrors($validator);

        $company = Auth::user()->company;
        
        $building = $company->buildings->keyBy('id')->get($request->id, new Building);

        $images = $building->images()->whereIn('image', $request->images)->get();

        foreach ($request->images as $image) {
            if ( Storage::exists('temp/'.$image) ) {
                Storage::move(
                    'temp/'.$image,
                    'images/'.$image
                );
            }
            if ( !$images->contains('image', $image) ) {
                $image = Image::create( ['image'=>$image] );
                $images->push($image);
            }
        }

        $building->images()->whereNotIn('id', $images)->delete();

        $building->company_id = $company->id;
        $building->name = $request->name;
        $building->type = $request->type;
        $building->information = $request->information;
        $building->published = $request->published;
        $building->save();
        $building->images()->sync($images);

        return redirect()->route('office.building.index');
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
        return view('user.building.form', [
            'title' => 'Изменить стройку',
            'building' => Auth::user()->company->buildings->keyBy('id')->get($id, new Building)
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
        //
    }

}
