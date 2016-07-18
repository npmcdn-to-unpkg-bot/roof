<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Storage;

class UserController extends Controller
{

    protected function fields (User $user) {

        return [
            [
                'name'=>'name',
                'type'=>'text',
                'placeholder'=>'Фамилия Имя Очетсва',
                'label'=>'ФИО',
                'value'=>old() ? old('name') : $user->name
            ],[
                'name' => 'image',
                'type' => 'images',
                'label' => 'Аватарка',
                'quantity' => 1,
                'values' => old() 
                    ? (array)old('image') 
                    : (array)$user->image
            ],[
                'name'=>'email',
                'type'=>'text',
                'placeholder'=>'Email',
                'label'=>'email',
                'value'=>old() ? old('email') : $user->email
            ],[
                'name'=>'phone',
                'type'=>'text',
                'placeholder'=>'Телефон',
                'label'=>'Телефон',
                'value'=>old() ? old('phone') : $user->phone
            ],
        ];
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = User::validator($request->all());
        if ($validator->fails())
            return back()->withInput()->withErrors($validator);

        $user = auth()->user();

        if ($request->image&&Storage::exists('temp/'.$request->image)) 
            Storage::move('temp/'.$request->image,'images/'.$request->image);

        if ($user->image&&$user->image!==$request->image) 
            Storage::delete('images/'.$user->image);

        $user->fill($request->only('title','image','entry','content','phone'));
        $user->save();

        return redirect('user');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = auth()->user();

        return view('admin.universal.edit',[
            'title' => 'Персональные данные',
            'action' => route('user.personal.store'),
            'fields' => $this->fields($user),
            'item' => $user
        ]);
    }

}
