<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Offer;

class DeskBlock
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
	public function compose (View $view) {
        $offers = Offer::take(5)->get();
        return $view->with('offers', $offers);
    }
}

