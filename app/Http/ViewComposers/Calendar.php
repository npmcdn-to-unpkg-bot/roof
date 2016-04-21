<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Carbon\Carbon;
class Calendar
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
	public function compose (View $view) {
		$data = $view->getData();
		$current = isset($data['current']) 
			? Carbon::parse($data['current'])
			: Carbon::now();
		$start = $current->copy()->startOfMonth()->startOfWeek();
		$end = $current->copy()->endOfMonth()->endOfWeek();
        return $view
        	->with('current', $current)
        	->with('start',$start)
        	->with('end',$end);
    }
}

