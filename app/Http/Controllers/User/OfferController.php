<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Auth;
use Image;
use Validator;
use App\Offer;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.desk.index', [
            'offers' => Auth::user()->offers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.desk.form', [
            'title' => 'Новое объявление',
            'offer' => new Offer
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

        $validator = Validator::make($request->all(), [
            'title' => 'required|min:10|max:55',
            'price' => 'required',
            'image' => 'required',
            'information' => 'max:1024',
            'specialisation' => 'required|min:3|max:35',
            'name' => 'max:35',
            'email' => 'email|max:255',
            'phone' => 'numeric',
        ],[
            'title.required' => 'Введите заголовк объявления.',
            'title.min' => 'Заголовок должен быть не меньше 10 символов.',
            'title.max' => 'Заголовок должен быть не больше 55 символов.',
            'price.required' => 'Введите цену.',
            'image.required' => 'Загрузите картинку.',
            'information.max' => 'Текст должен быть не больше 1024 символов.',
            'specialisation.required' => 'Введите специализацию.',
            'specialisation.min' => 'Текст специализации должен быть не меньше 3 символов.',
            'specialisation.max' => 'Текст специализации должен быть не больше 35 символов.',
            'name.max' => 'Имя должно быть не длинее 35 символов',
            'email.email' => 'Введите корректный email.',
            'email.max' => 'Email должен быть не длинее 255 символов.',
            'phone.numeric' => 'Телефон должен состоять из цифр.',
        ]);


        if ($validator->fails())
            return back()->withInput()->withErrors($validator);

        $user = Auth::user();
        $offer = $user->offers->keyBy('id')->get($request->id, new Offer);

        $offer->user_id = $user->id;
        $offer->title = $request->title;
        $offer->price = $request->price;
        $offer->image = $request->image;
        $offer->information = $request->information;
        $offer->specialisation = $request->specialisation;
        $offer->name = $request->name;
        $offer->email = $request->email;
        $offer->phone = $request->phone;
        $offer->save();
        $offer->deskcategories()->sync($request->deskcategories ? $request->deskcategories : []);

        return redirect()->route('office.offer.index');
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
        return view('user.desk.form', [
            'title' => 'Новое объявление',
            'offer' => Auth::user()->offers->keyBy('id')->get($id, new Offer)
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
