<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Catalog\Company;

class AssociationBlock
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
	public function compose (View $view) {
        $association = Company::where('association', 1)->orderByRaw("RAND()")->get();
        return $view->with('association', $association);
    }
}

