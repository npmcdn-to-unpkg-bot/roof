<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Company;

class PublicAssociationComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
	public function compose (View $view) {
        $association = Company::where('association', 1)->get();
        return $view
	        ->with('association', $association);
    }
}

