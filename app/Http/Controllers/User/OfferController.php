<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Offer;
use App\Category;
use Validator;
use Storage;
use Auth;
use App\Country;
use App\City;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Service;

class OfferController extends Controller
{

    protected function fields (Offer $offer) {

        $fields = collect();
        $fields
            ->push([
                'name'=>'title',
                'type'=>'text',
                'placeholder'=>'Введите заголовок объявления',
                'label'=>'Заголовок',
                'value'=>old() ? old('title') : $offer->title
            ])
            ->push([
                'name' => 'image',
                'type' => 'images',
                'label' => 'Картинка',
                'quantity' => 1,
                'values' => old() 
                    ? (array)old('image') 
                    : (array)$offer->image
            ])
            ->push([
                'name'=>'price',
                'type'=>'price',
                'placeholder'=>'Введите цену',
                'label'=>'Цена',
                'value'=>old() ? old('price') : $offer->price
            ]);
        if (auth()->user()->company&&auth()->user()->company->level == 3)
            $fields
            ->push([
                'name'=>'old_price',
                'type'=>'price',
                'placeholder'=>'Введите цену',
                'label'=>'Старая цена',
                'value'=>old() ? old('old_price') : $offer->old_price
            ]);
        $fields
            ->push([
                'name'=>'information',
                'type'=>'textarea',
                'placeholder'=>'Введите текст',
                'label'=>'Текст объявления',
                'value'=>old() ? old('information') : $offer->information
            ])
            ->push([
                'name'=>'specialisation',
                'type'=>'text',
                'placeholder'=>'Введите специализацию',
                'label'=>'Специализация',
                'value'=>old() ? old('specialisation') : $offer->specialisation
            ])
            ->push([
                'name'=>'name',
                'type'=>'text',
                'placeholder'=>'Введите имя',
                'label'=>'Имя',
                'value'=>old() ? old('name') : $offer->name
            ])
            ->push([
                'name'=>'email',
                'type'=>'text',
                'placeholder'=>'Введите email',
                'label'=>'Email',
                'value'=>old() ? old('email') : $offer->email
            ])
            ->push([
                'name'=>'phone',
                'type'=>'text',
                'placeholder'=>'Введите телефоны через запятую: +38000000000,+38000000000,+38000000000',
                'label'=>'Телефон',
                'value'=>old() ? old('phone') : $offer->phone
            ])
            ->push([
                'type' => 'address',
                'label' => 'Адрес',
                'lat' => old() ? old('lat') : $offer->lat,
                'lng' => old() ? old('lng') : $offer->lng,
                'country' => old() 
                    ? Country::firstOrNew(['id'=>old('country_id')])
                    : ($offer->city ? $offer->city->country : Country::firstOrNew(['name'=>'Украина'])),
                'city' => old() 
                    ? City::firstOrNew(['id'=>old('city_id')])
                    : ($offer->city ? $offer->city : City::firstOrNew(['name'=>'Киев'])),
                'address' => old() 
                    ? old('address') 
                    : $offer->address
            ])
            ->push([
                'name' => 'categories',
                'type' => 'select_multiple',
                'label' => 'Категории',
                'values' => old() ? (array)old('categories') : $offer->categories->lists('id')->all(),
                'options' => Category::lists('name','id')
            ]);

        return $fields;
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $offers = Auth::user()->offers()->paginate(15);
        $th = [
            [
                'title'=>'Картинка',
                'width'=>'40px',
            ],[
                'title'=>'Заголовок',
                'width'=>'auto',
            ],[
                'title'=>'',
                'width'=>'50px',
            ],[
                'title'=>'',
                'width'=>'100px',
            ],[
                'title'=>'',
                'width'=>'100px',
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
                    'up' => '/user/offers/up/'.$offer->id,
                    'type'=>'up',
                ],[
                    'html'=>'<a class="btn btn-success" href="'.route('user.offers.services.edit',$offer).'">Рекламировать</a>',
                    'type'=>'html',
                ],[
                    'edit' => route('user.offers.edit', $offer),
                    'delete' => route('user.offers.destroy', $offer),
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
            'title' => 'Добавить объявление',
            'action' => route('user.offers.store'),
            'fields' => $this->fields($offer),
            'item' => $offer,
            'promote' => true,
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

        $offer = Auth::user()->offers()->firstOrNew(['id' => $request->id]);

        if ($request->image&&Storage::exists('temp/'.$request->image)) 
            Storage::move('temp/'.$request->image,'images/'.$request->image);
        
        if ($offer->image&&$offer->image!==$request->image) 
            Storage::delete('images/'.$offer->image);

        if (auth()->user()->company->level == 3)
            $offer->old_price = $request->old_price;

        $offer
            ->fill($request->only('title','image','price','specialisation','name','email','phone','information','lat','lng','address','city_id'))
            ->save();
        
        $offer->categories()->sync((array)$request->categories);

        if ($request->promote) return redirect()->route('user.offers.services.edit', $offer);

        return redirect()->route('user.offers.index');
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

        $offer = Auth::user()->offers()->where('id', $id)->first();
        if (!$offer) return redirect()->route('user.offer.create');

        return view('admin.universal.edit',[
            'title' => 'Редактировать объявление',
            'action' => route('user.offers.store'),
            'fields' => $this->fields($offer),
            'item' => $offer,
            'promote' => true,
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
        Auth::user()->offers()->where('id', $id)->delete();
        return back();
    }
    
    public function up($id)
    {
        $order = Offer::find($id)->orders()->create([
            'user_id' => auth()->user()->id,
            'service_id' => Service::where('group','offer_up')->first()->id
        ]);
        return redirect()->route('user.orders.index');
    }
}
