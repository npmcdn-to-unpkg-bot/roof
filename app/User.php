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
        'name', 'email', 'password', 'job', 'phone', 'image','company_id','join_company_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tenders () {
        return $this->hasMany('App\Models\Tender');
    }

    public function jobs () {
        return $this->hasMany('App\Models\Building\Job');
    }

    public function company () {
        return $this->belongsTo('App\Models\Catalog\Company');
    }

    public function member_in_company () {
        if ($this->company_id){
            return $this->belongsTo('App\Models\Catalog\Company','company_id');
        }else{
            return $this->belongsTo('App\Models\Catalog\Company','join_company_id');
        }
    }

    public function offers () {
        return $this->hasMany('App\Offer');
    }

    public function orders () {
        return $this->hasMany('App\Models\Order');
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
            'email' => 'required|regex:/(.*)@(.*)/|max:255',
            'name' => 'required|max:255',
        ],[
            'email.required' => 'Введите вашу электронную почту.',
            'email.regex' => 'Введите корректную электронную почту.',
            'email.max' => 'Слишком длинная электронная почта.',
            'name.required' => 'Введите ваше имя.',
            'name.max' => 'Слишком длинное имя.',
        ]);
    }

}
