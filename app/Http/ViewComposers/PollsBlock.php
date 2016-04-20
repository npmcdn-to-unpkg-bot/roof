<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Option;
use App\Poll;

class PollsBlock
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
	public function compose (View $view) {
        $option = Option::firstValue('poll_active');
        $poll = Poll::with('votes')->find($option);
        return $view->with('poll', $poll);
    }
}

