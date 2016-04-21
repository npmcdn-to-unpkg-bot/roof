<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Offer;
use App\User;
use Image;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class OfferController extends Controller
{

    protected $table = [
        [
            'field'=>'image',
            'type'=>'image',
            'width'=>'40px',
            'title'=>'Картинка'
        ],[
            'field'=>'title',
            'type'=>'text',
            'width'=>'auto',
            'title'=>'Заголовок'
        ],[
            'field'=>'id',
            'type'=>'actions',
            'width'=>'90px',
            'title'=>''
        ],
    ];

    protected function fields (Offer $offer) {

        return [
            [
                'name'=>'title',
                'type'=>'text',
                'placeholder'=>'Введите заголовок объявления',
                'label'=>'Заголовок',
                'value'=>old() ? old('title') : $offer->title
            ],[
                'name'=>'image',
                'type'=>'image',
                'label'=>'Картинка',
                'value'=>old() ? old('image') : $offer->image
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
                'name'=>'framed',
                'type'=>'checkbox',
                'label'=>'Выделить рамкой',
                'value'=>old() ? old('framed') : $offer->framed
            ],[
                'name'=>'user_id',
                'type'=>'select',
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

        return view('admin.table', [
            'table' => $this->table,
            'items' => $offers,
            'title' => 'Объявления',
            'links' => [
                'show' => 'admin.offers.show',
                'edit' => 'admin.offers.edit',
                'delete' => 'admin.offers.destroy'
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

        $offer = new Offer;

        return view('admin.form',[
            'title' => 'Добавить новость',
            'action' => 'admin.news.store',
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
        if ($request->hasFile('upload')) {
            $image = time().'-'
                .$request->file('upload')->getClientOriginalName();
            Image::make($request
                ->file('upload'))
                ->fit(1600, 1024, function ($constraint) { $constraint->upsize(); })
                ->save(storage_path('app/images/').$image);
            $request->merge(['image' => $image]);
        }

        $validator = Validator::make(
            $request->all(), 
            Offer::$rules, 
            Offer::$messages
        );

        if ($validator->fails()) 
            return back()->withInput()->withErrors($validator);

        Offer::firstOrNew(['id' => $request->id])
            ->fill($request->only('title','image','price','specialisation','name','email','phone','framed','information'))
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

        return view('admin.form',[
            'title' => 'Редактировать объявление',
            'action' => 'admin.offers.store',
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
