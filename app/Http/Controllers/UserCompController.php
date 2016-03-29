<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use Image;
use App\Comp;
use App\User;
use App\Http\Requests;

class UserCompController extends Controller
{
    public function create () {
    	return view('user.comp.create');
    }

    public function store (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|numeric',
            'user_name' => 'required|max:255',
            'logo' => 'required|image'
        ],[
        	'name.required' => 'Введите название компании.',
        	'name.max' => 'Название компании должно быть не больше 255 символов.',
        	'email.required' => 'Введите электронную почту компании.',
        	'email.email' => 'Введите корректную электронную почту компании.',
        	'email.max' => 'Электронная почта не должна быть больше 255 символов.',
        	'phone.required' => 'Введите телефон компании.',
        	'phone.numeric' => 'Телефон должен состоять из цифр.',
        	'logo.required' => 'Загрузите логотип.',
        	'logo.image' => 'Формат картинки должен быть jpeg, png, bmp, gif, или svg',
        ]);


        if ($validator->fails()) {
			return back()
				->withInput()
				->withErrors($validator);
		}

	    $user = Auth::user();
	    $user->name = $request->user_name;
	    $user->phone = $request->user_phone;
	    $user->job = $request->user_job;
	    $user->save();

	    $logo = time().'-'
	    		.$request->file('logo')->getClientOriginalName();
		Image::make($request
				->file('logo'))
				->fit(600, 500, function ($constraint) { $constraint->upsize(); })
    			->save('uploads/images/'.$logo);

	    $comp = new Comp;
	    $comp->user_id = $user->id;
	    $comp->name = $request->name;
	    $comp->email = $request->email;
	    $comp->logo = $logo;
	    $comp->phone = $request->phone;
	    $comp->name = $request->name;
	    $comp->entry = $request->entry;
	    $comp->save();


	    return redirect('/office');
    }
}
