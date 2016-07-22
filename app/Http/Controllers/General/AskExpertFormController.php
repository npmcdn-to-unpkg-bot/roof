<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Mail;
use App\Option;

class AskExpertFormController extends Controller
{
    public function index() {
    	return view('general.askexpert.index');
    }

    public function store(Request $request) {
    	$validator = Validator::make($request->all(),[
    		'name' => 'required',
    		'phone' => 'required|regex:"^\+38[0-9]{10}$"',
		],[
			'name.required' => 'Поле имя обязательно для ввода',
			'phone.required' => 'Поле телефон обязательно для ввода',
			'phone.regex' => 'Введите телефон в формате +38XXXXXXXXXX'
		]);

		if ($validator->fails())
			return redirect()->route('ask-expert.index')->withErrors($validator)->withInput();

		Mail::send('general.askexpert.mail', $request->all(), function($m){
			$m->from('sent_form@roofers.com.ua','roofers.com.ua');
			$m->to(Option::firstOrNew(['name'=>'email_ask_expert'])->value,'info')
				->subject('Новое отправление формы "Задать вопрос эксперту"');
		});

    	return '<div class="title" style="padding:50px;">Запрос успешно доставлен</div>';
    }
}
