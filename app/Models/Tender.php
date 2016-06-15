<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Tender extends Model
{
    protected $table = 'tenders';

    protected $fillable = ['name','company_id','budget','end','description','image','person','email','phone','user_id','meta_title','meta_description'];

	protected $dates = ['created_at', 'updated_at', 'end'];

    public function user () {
        return $this->belongsTo('App\User');
    }

    public static function validator ($fields) {
    	return Validator::make($fields,[
				'name' => 'required|max:255',
				'budget' => 'max:255',
				'end' => 'required',
    		],[
				'name.required' => 'Введите название тендера.',
				'name.max' => 'Название тендера должно быть не больше 255 символов.',
				'budget.max' => 'Описание бюджета должно быть не больше 255 символов.',
				'end.required' => 'Выберите дату окончания приема заявок.',
    		]);
    }

    public function company () {
    	return $this->belongsTo('App\Models\Catalog\Company');
    }
}
