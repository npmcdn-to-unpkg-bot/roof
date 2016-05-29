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
        $offers = Offer::take(6)->orderBy('created_at')->get();
        return $view->with('offers', $offers);
    }
}

