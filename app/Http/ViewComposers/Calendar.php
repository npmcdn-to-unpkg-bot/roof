<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Carbon\Carbon;
use App\Event;

class Calendar
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
	public function compose (View $view){
		$data = $view->getData();
        $class = isset($data['class'])
            ? $data['class']
            : false;
		$current = isset($data['current']) 
			? Carbon::parse($data['current'])
			: Carbon::now();
        $startOfMonth = $current->copy()->startOfMonth();
        $endOfMonth = $current->copy()->endOfMonth();
		$startCalendar = $startOfMonth->copy()->startOfWeek();
		$endCalendar = $endOfMonth->copy()->endOfWeek();

        $events = collect();
        for ($i=$startOfMonth->day;$i<=$endOfMonth->day;$i++) {
            $events->put($i,collect());
        }

        $eventsQuery = Event::where([
                ['end','>=',$startOfMonth],
                ['start','<=',$endOfMonth],
            ])->get();

        foreach ($eventsQuery as $event) {
            $start = max($event->start, $startOfMonth);
            $end = min($event->end, $endOfMonth);
            for($i=$start->day;$i<=$end->day;$i++) {
                $events[$i]->push($event);
            }
        }

        $next = Event::where([['end','>=',$endOfMonth]])->count();
        $prev = Event::where([['start','<=',$startOfMonth]])->count();

        return $view
        	->with('current', $current)
        	->with('start',$startCalendar)
        	->with('end',$endCalendar)
        	->with('events',$events)
            ->with('class',$class)
            ->with('next',$next)
            ->with('prev',$prev);
    }
}

