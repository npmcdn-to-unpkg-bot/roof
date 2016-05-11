<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Tender extends Model
{
    protected $table = 'tenders';

    protected $fillable = ['name','company_id','budget','end','description','image','person','email','phone'];

	protected $dates = ['created_at', 'updated_at', 'end'];

    public static function validator ($fields) {
    	return Validator::make($fields,[
				'name' => 'required|max:255',
				'company' => 'required',
				'budget' => 'required|max:255',
				'end' => 'required',
    		],[
				'name.required' => 'Введите название тендера.',
				'name.max' => 'Название тендера должно быть не больше 255 символов.',
				'company.required' => 'Выберите компанию которая проводит тендер.',
				'budget.required' => 'Введите бюджет.',
				'budget.max' => 'Описание бюджета должно быть не больше 255 символов.',
				'end.required' => 'Выберите дату окончания приема заявок.',
    		]);
    }

    public function company () {
    	return $this->belongsTo('App\Models\Catalog\Company');
    }
}
