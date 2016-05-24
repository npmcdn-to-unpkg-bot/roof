<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Catalog\Company;
use App\Models\Building\Building;

class Buildings
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
	public function compose (View $view) {
        $buildings = Building::orderByRaw("RAND()")->take(3)->get();
        return $view->with('buildings', $buildings);
    }
}

