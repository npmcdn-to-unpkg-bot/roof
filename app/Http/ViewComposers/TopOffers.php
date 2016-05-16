<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Offer;
use Carbon\Carbon;

class TopOffers
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
	public function compose (View $view) {
        $offers = Offer::where('top','>',Carbon::now())->orderBy('queue','desc')->take(2)->get();
        foreach ($offers as $offer) {
            $offer->queue=1;
            $offer->save();
        }
        Offer::where('top','1')->whereNotIn('id', $offers->lists('id'))->increment('queue');
        return $view->with('offers', $offers);
    }
}