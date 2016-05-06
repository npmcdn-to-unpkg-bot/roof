<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'job', 'phone', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function company () {
        return $this->hasOne('App\Models\Catalog\Company');
    }

    public function offers () {
        return $this->hasMany('App\Offer');
    }

    public function roles () {
        return $this->belongsToMany('App\Role');
    }
    
    public function votes () {
        return $this->belongsToMany('App\Vote');
    }

    public function hasPoll (Poll $poll) {
        return $this->votes()->where('poll_id',$poll->id)->first();
    }

    public function hasRole ($role) {
        return $this->roles()->where('role', $role)->first();
    }

    public static function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255',
            'name' => 'required|max:255',
        ],[
            'email.required' => 'Введите вашу электронную почту.',
            'email.email' => 'Введите корректную электронную почту.',
            'email.max' => 'Слишком длинная электронная почта.',
            'name.required' => 'Введите ваше имя.',
            'name.max' => 'Слишком длинное имя.',
        ]);
    }

}
