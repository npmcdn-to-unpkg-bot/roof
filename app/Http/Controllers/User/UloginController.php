<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\User;
use Storage;
use Image;

class UloginController extends Controller
{

    public function index (Request $request) {
        $uLogin = json_decode(
            file_get_contents('http://ulogin.ru/token.php?token=' . $request->uToken . '&host=' . $_SERVER['HTTP_HOST']),
            true
        );

        $user = User::firstOrNew(['email'=>$uLogin['email']]);
        $user->{$uLogin['network']} = $uLogin['profile'];
        $user->name = $user->name 
        		? $user->name 
        		: $uLogin['first_name'] . ' ' . $uLogin['last_name'];
        if (!$user->image) {
        	$user->image = time().'-'.str_slug($user->name).'.jpg';
        	Image::make($uLogin['photo_big'])->save(storage_path('app/images/').$user->image);
        }
        $user->save();
        auth()->login($user, $remember = true);

		return redirect()->intended('user');
    }
}
