<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Offer;
use App\User;
use Storage;
use Validator;
use App\Country;
use App\City;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class OfferController extends Controller
{

    protected function fields (Offer $offer) {

        return [
            [
                'name'=>'title',
                'type'=>'text',
                'placeholder'=>'Введите заголовок объявления',
                'label'=>'Заголовок',
                'value'=>old() ? old('title') : $offer->title
            ],[
                'name' => 'image',
                'type' => 'images',
                'label' => 'Картинка',
                'quantity' => 1,
                'values' => old() 
                    ? (array)old('image') 
                    : (array)$offer->image
            ],[
                'name'=>'price',
                'type'=>'text',
                'placeholder'=>'Введите цену',
                'label'=>'Цена',
                'value'=>old() ? old('price') : $offer->price
            ],[
                'name'=>'information',
                'type'=>'textarea',
                'placeholder'=>'Введите текст',
                'label'=>'Текст объявления',
                'value'=>old() ? old('information') : $offer->information
            ],[
                'name'=>'specialisation',
                'type'=>'text',
                'placeholder'=>'Введите специализацию',
                'label'=>'Специализация',
                'value'=>old() ? old('specialisation') : $offer->specialisation
            ],[
                'name'=>'name',
                'type'=>'text',
                'placeholder'=>'Введите имя',
                'label'=>'Имя',
                'value'=>old() ? old('name') : $offer->name
            ],[
                'name'=>'email',
                'type'=>'text',
                'placeholder'=>'Введите email',
                'label'=>'Email',
                'value'=>old() ? old('email') : $offer->email
            ],[
                'name'=>'phone',
                'type'=>'text',
                'placeholder'=>'Введите телефон',
                'label'=>'Телефон',
                'value'=>old() ? old('phone') : $offer->phone
            ],[
                'type' => 'address',
                'label' => 'Адрес',
                'lat' => old() ? old('lat') : $offer->lat,
                'lng' => old() ? old('lng') : $offer->lng,
                'country' => old() 
                    ? Country::firstOrNew(['id'=>old('country_id')])
                    : ($offer->city ? $offer->city->country : new Country),
                'city' => old() 
                    ? City::firstOrNew(['id'=>old('city_id')])
                    : ($offer->city ? $offer->city : new Country),
                'address' => old() 
                    ? old('address') 
                    : $offer->address
            ],[
                'name'=>'framed',
                'type'=>'checkbox',
                'label'=>'Выделить рамкой',
                'value'=>old() ? old('framed') : $offer->framed
            ],[
                'name'=>'user_id',
                'type'=>'select',
                'settings'=>'',
                'label'=>'Пользователь',
                'value'=>old() 
                    ? old('user_id') 
                    : ($offer->user ? $offer->user->id : ''),
                'options'=>User::lists('email','id')
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

        $offers = Offer::paginate(15);
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
            ],
        ];
        $table=collect()->push($th);
        foreach ($offers as $offer){
            $table->push([
                [
                    'field'=>$offer->image,
                    'type'=>'image',
                ],[
                    'field'=>$offer->title,
                    'type'=>'text',
                ],[
                    'edit' => route('admin.offers.edit', $offer),
                    'delete' => route('admin.offers.destroy', $offer),
                    'type'=>'actions',
                ],
            ]);
        }
        return view('admin.universal.index', [
            'table' => $table,
            'items' => $offers,
            'title' => 'Объявления',
            'pagination' => $offers->render()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $offer = new Offer;

        return view('admin.universal.edit',[
            'title' => 'Добавить новость',
            'action' => route('admin.offers.store'),
            'fields' => $this->fields($offer),
            'item' => $offer
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
        $validator = Validator::make($request->all(), Offer::$rules, Offer::$messages);
        if ($validator->fails()) 
            return back()->withInput()->withErrors($validator);

        $offer = Offer::firstOrNew(['id' => $request->id]);
        
        if ($request->image&&Storage::exists('temp/'.$request->image)) 
            Storage::move('temp/'.$request->image,'images/'.$request->image);
        
        if ($offer->image&&$offer->image!==$request->image) 
            Storage::delete('images/'.$offer->image);

        $offer
            ->fill($request->only('title','image','price','specialisation','name','email','phone','framed','information','lat','lng','address','city_id'))
            ->save();

        return redirect()->route('admin.offers.index');
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

        $offer = Offer::find($id);

        return view('admin.universal.edit',[
            'title' => 'Редактировать объявление',
            'action' => route('admin.offers.store'),
            'fields' => $this->fields($offer),
            'item' => $offer
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
        Offer::find($id)->delete();

        return back();
    }
}
