<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
class PasswordController extends Controller
{

    protected function fields () {

        return [
            [
                'name'=>'password',
                'type'=>'password',
                'placeholder'=>'Новый пароль',
                'label'=>'Новый пароль',
            ],[
                'name'=>'password_confirmation',
                'type'=>'password',
                'placeholder'=>'Повторите новый пароль',
                'label'=>'Повторите новый пароль',
            ]
        ];
        
    }


    public function index() {
        return view('admin.universal.edit',[
            'title' => 'Изменить пароль',
            'action' => route('user.password.store'),
            'fields' => $this->fields(),
        ]);
    }

    public function store(Request $request) {
        $validator =  Validator::make($request->all(), [
            'password' => 'required|min:6|confirmed',
        ],[
            'password.required' => 'Пароль должен быть не менее 6 символов.',
            'password.min' => 'Пароль должен быть не менее 6 символов.',
            'password.confirmed' => 'Повтор пароля должен совпадать.',
        ]);

        if($validator->fails())
        	return back()->withErrors($validator);

        $user = auth()->user();
        $user->password = bcrypt($request->password);
        $user->save();
        
        return redirect('user');
    }
}
