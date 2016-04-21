<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'job', 'phone'
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
        return $this->hasOne('App\Company');
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

}
