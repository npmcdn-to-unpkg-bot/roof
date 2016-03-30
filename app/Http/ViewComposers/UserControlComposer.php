<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Auth;
use App\Company;
use App\User;

class UserControlComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
	public function compose (View $view) {
        $user = Auth::user();
        $company = $user->company;
        return $view
	        ->with('user', $user)
	        ->with('company', $company);
    }
}

