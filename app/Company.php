<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    public static $rules = [
        'name' => 'required|max:35',
        'email' => 'required|email|max:255',
        'phone' => 'required|numeric',
        'logo' => 'required',
        'entry' => 'max:255'
    ];

    public static $messages = [
        'name.required' => 'Введите название компании.',
        'name.max' => 'Название компании должно быть не больше 35 символов.',
        'email.required' => 'Введите электронную почту компании.',
        'email.email' => 'Введите корректную электронную почту компании.',
        'email.max' => 'Электронная почта не должна быть больше 255 символов.',
        'phone.required' => 'Введите телефон компании.',
        'phone.numeric' => 'Телефон должен состоять из цифр.',
        'logo.required' => 'Загрузите логотип.',
        'entry.max' => 'Краткое описание не должно быть длинее 255 символов.'
    ];

	protected $table = 'companies';

    protected $fillable = [ 'name', 'logo', 'address', 'email', 'phone', 'entry', 'about', 'services', 'association', 'privat' , 'user_id' ];

    protected $dates = ['created_at', 'updated_at'];

    public function user () {
    	return $this->belongsTo('App\User');
    }

    public function buildings () {
        return $this->hasMany('App\Building');
    }

    public function jobs () {
        return $this->hasMany('App\Job');
    }

    public function articles () {
        return $this->hasMany('App\Article');
    }

    public function sales () {
        return $this->hasMany('App\Sale');
    }

    public function propositions () {
    	return $this->belongsToMany('App\Proposition');
    }

    public function specialisations () {
    	return $this->belongsToMany('App\Specialisation');
    }    
}
