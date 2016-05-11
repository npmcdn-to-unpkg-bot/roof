<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\User;
use Storage;

class UloginController extends Controller
{
    public function index (Request $request) {
        $uLogin = json_decode(
            file_get_contents('http://ulogin.ru/token.php?token=' . $request->uToken . '&host=' . $_SERVER['HTTP_HOST']),
            true
        );

        $user = User::firstOrNew(['email'=>$uLogin['email']]);
        $user->{$uLogin['network']} = $uLogin['profile'];
        $user->name = $user->name ? $user->name : $uLogin['first_name'] . ' ' . $uLogin['last_name'];
        $user->save();
        auth()->login($user);
		return redirect('user');
    }
}
