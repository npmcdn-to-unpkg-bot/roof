<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Validator;

use App\Image;

use Storage;

use App\Building;

use Auth;

class UserBuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buildings = Auth::user()->company->buildings;
        return view('user.building.index', [
                'buildings' => $buildings
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Добавить стройку';
        $data['building'] = new Building;
        return $this->getForm($data);
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
                'information' => 'required|min:50|max:255'
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

        $user = Auth::user();
        
        $building = Building::find($request->id);

        $building = $building && $building->company->user->id == $user->id
                    ? $building 
                    : new Building;

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

        $building->company_id = $user->company->id;
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
        $title = 'Изменить стройку';
        $building = Building::find($id);

        if (!$building||$building->company->user->id !== Auth::user()->id) 
            return redirect()->route('office.building.create');

        return $this->getForm([
                'title' => $title,
                'building' => $building
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

    protected function getForm($data) {

        return view('user.building.form', $data);

    }
}
