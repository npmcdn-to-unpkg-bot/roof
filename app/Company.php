<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    public static $rules = [
        'name' => 'required|max:255',
        'email' => 'required|max:255',
        'phone' => 'required',
        'logo' => 'required',
        'entry' => 'max:255'
    ];

    public static $messages = [
        'name.required' => 'Введите название компании.',
        'name.max' => 'Название компании должно быть не больше 255 символов.',
        'email.required' => 'Введите электронную почту компании.',
        'email.email' => 'Введите корректную электронную почту компании.',
        'email.max' => 'Электронная почта не должна быть больше 255 символов.',
        'phone.required' => 'Введите телефон компании.',
        'logo.required' => 'Загрузите логотип.',
        'entry.max' => 'Краткое описание не должно быть длинее 255 символов.'
    ];

	protected $table = 'companies';

    protected $fillable = [
        'name',
        'logo',
        'email',
        'phone',
        'entry',
        'about',
        'services',
        'association',
        'privat',
        'address',
        'user_id',
        'lat',
        'lng',
        'city_id',
        'address'
    ];

    protected $dates = ['created_at','updated_at'];

    public function printAddress () {
        if (!empty($this->address)) {
            $address = $this->city->country->name.', г. '.$this->city->name;
            $address.=', '.$this->address;
        };
        return $address;
    }

    public function user () {
    	return $this->belongsTo('App\User');
    }

    public function city () {
        return $this->belongsTo('App\City');
    }

    public function buildings () {
        return $this->hasMany('App\Models\Building\Building');
    }

    public function jobs () {
        return $this->hasMany('App\Models\Building\Job');
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
