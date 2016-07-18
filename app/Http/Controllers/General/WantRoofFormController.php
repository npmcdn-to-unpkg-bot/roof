<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Mail;
use App\Option;

class WantRoofFormController extends Controller
{
    public function index() {
    	return view('general.wantroof.index');
    }

    public function store(Request $request) {
    	$validator = Validator::make($request->all(),[
    		'name' => 'required',
    		'phone' => 'required',
		],[
			'name.required' => 'Поле имя обязательно для ввода',
			'phone.required' => 'Поле телефон обязательно для ввода',
		]);

		if ($validator->fails())
			return redirect()->route('want-roof.index')->withErrors($validator)->withInput();

		Mail::send('general.wantroof.mail', $request->all(), function($m){
			$m->from('sent_form@roofers.com.ua','roofers.com.ua');
			$m->to(Option::firstOrNew(['name'=>'email_want_roof'])->value,'info')
				->subject('Новое отправление формы "ХОЧУ КРОВЛЮ"');
		});

    	return '<div class="title" style="padding:50px;">Запрос успешно доставлен</div>';
    }
}
