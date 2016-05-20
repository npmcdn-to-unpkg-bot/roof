<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use LiqPay;

class PayController extends Controller
{	
	protected $public_key = 'i48589244001';
	protected $private_key = 'KL21yzcLCKzeMqXrvAmEVqcn2BzVixAEMYtMDJQ3';

    public function index () {

		$liqpay = new LiqPay($this->public_key, $this->private_key);

		$payment_form = $liqpay->cnb_form([
			'version'        => 3,
			'action'         => 'pay',
			'amount'         => '1',
			'currency'       => 'UAH',
			'sandbox'        => '1',
			'description'    => 'Поднять объявление в топ на две недели',
			'order_id'       => '',
			'result_url'     => url('user/payment'),

		]);

    	return view('admin.payment.index',[
    		'payment_form' => $payment_form
    	]);
    }

    public function complete (Request $request) {
		$signature = base64_encode( sha1( 
		$this->private_key .  
		$request->data . 
		$this->private_key
		, 1 ));
		$data = base64_decode ($request->data);
    	?><pre><?php print_r($data) ?></pre> <?php
    	die();
    }
}
