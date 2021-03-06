<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Company extends Model
{

    protected $table = 'catalog_companies';

    public static function validator ($fields) {
        return Validator::make($fields, [
                'name' => 'required|max:255',
                'email' => 'max:255|regex:/(.*)@(.*)/',
                'phone' => 'required',
                'logo' => 'required',
                'entry' => 'max:255'
            ],[
                'name.required' => 'Введите название компании.',
                'name.max' => 'Название компании должно быть не больше 255 символов.',
                'email.regex' => 'Введите корректную электронную почту компании.',
                'email.max' => 'Электронная почта не должна быть больше 255 символов.',
                'phone.required' => 'Введите телефон компании.',
                'logo.required' => 'Загрузите логотип.',
                'entry.max' => 'Краткое описание не должно быть длинее 255 символов.'
            ]);
    }

    protected $fillable = [
        'name',
        'logo',
        'email',
        'site',
        'phone',
        'level',
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
        'address',
        'meta_title',
        'meta_description'
    ];

    protected $dates = ['created_at','updated_at'];

    public function printAddress () {
        if ($this->city) {
            return $this->city->country->name.', г. '
                .$this->city->name.', '
                .$this->address;
        };
        return false;
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

    public function posts () {
        return $this->hasMany('App\Models\Catalog\Post');
    }

    public function sales () {
        return $this->hasMany('App\Sale');
    }

    public function users () {
        return $this->hasMany('App\User');
    }

    public function reserves () {
        return $this->hasMany('App\Models\Reserve');
    }

    public function new_users () {
        return $this->hasMany('App\User','join_company_id');
    }

    public function prices () {
        return $this->hasMany('App\Models\Catalog\Price');
    }


    public function examples () {
        return $this->hasMany('App\Models\Catalog\Example');
    }

    public function tenders () {
        return $this->hasMany('App\Models\Tender');
    }

    public function propositions () {
    	return $this->belongsToMany(
            'App\Models\Catalog\Proposition',
            'catalog_company_proposition',
            'company_id',
            'proposition_id'
        );
    }

    public function specialisations () {
    	return $this->belongsToMany(
            'App\Models\Catalog\Specialisation',
            'catalog_company_specialisation',
            'company_id',
            'specialisation_id'
        );
    }

    public function comments() {
        return $this->morphMany('App\Models\Comment','commentable');
    }
    public function orders () {
        return $this->morphMany('App\Models\Order','orderable');
    }

    public function level_print(){

        if ($this->association)
            return 'Член ассоциации';

        $pattern = [
            0 => '',
            1 => 'Старт',
            2 => 'Бизнес',
            3 => 'Премиум'
        ];
        
        return $pattern[$this->level];
    }
}
