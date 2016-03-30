<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use Image;
use App\Company;
use App\User;
use App\Specialisation;
use App\Proposition;
use App\Http\Requests;

class UserCompanyController extends Controller
{
    public function create () {
    	$data['title'] = 'ДОБАВЛЕНИЕ КОМПАНИИ';
    	$data['company'] = new Company;
    	return $this->getForm($data);
    }

    public function update () {
    	$data['title'] = 'ДАННЫЕ КОМПАНИИ';
    	$data['company'] = Auth::user()->company;
    	return $this->getForm($data);
    }   

    protected function getForm ($data) {
    	$data['specialisations'] = Specialisation::all();
    	$data['propositions'] = Proposition::all();
    	return view('user.company.create', $data);
    }


    public function store (Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|numeric',
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

	    $logo = time().'-'
	    		.$request->file('logo')->getClientOriginalName();
		Image::make($request
				->file('logo'))
				->fit(600, 500, function ($constraint) { $constraint->upsize(); })
    			->save(storage_path('uploads/images/').$logo);

    	$user = Auth::user();
	    $company = $user->company
	    		?$user->company
	    		:new Company;
	    $company->user_id = $user->id;
	    $company->name = $request->name;
	    $company->email = $request->email;
	    $company->logo = $logo;
	    $company->phone = $request->phone;
	    $company->name = $request->name;
	    $company->entry = $request->entry;
	    $company->save();
	    $company->specialisations()->sync($request->specialisations);
	    $company->propositions()->sync($request->propositions);


	    return redirect('/office');
    }
}
