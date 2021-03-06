<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Service;

class Service extends Model
{
    protected $table = 'services';

    public $timestamps = false;

    public function orders() {
    	return $this->hasMany('App\Models\Order');
    }

    public function apply($orderable) {
    	$callback = $this->callback;
    	$this->$callback($orderable);
    	return $this;
    }

    public function offer_top($orderable) {
    	$orderable->top = Carbon::now()->addDay($this->value);
    	$orderable->save();
    }
    public function offer_framed ($orderable) {
    	$orderable->framed = Carbon::now()->addDay($this->value);
    	$orderable->save();
    }
    public function offer_up ($orderable) {
        $orderable->created_at = Carbon::now();
        $orderable->save();
    }
    public function company_level ($orderable) {
        if ($orderable->level < $this->value) {
            $orderable->level = $this->value;
            $orderable->level_end = Carbon::now()->addYear();
        }

        if ($this->value == 1) {
            $reserveOffers = $orderable->reserves()->firstOrNew([
                'service_id' => Service::where('group','offer_framed')->where('value','7')->firstOrNew([])->id
            ]);
            $reserveOffers->count += 5;
            $reserveOffers->save();

            $reserveOffers = $orderable->reserves()->firstOrNew([
                'service_id' => Service::where('group','poll')->firstOrNew([])->id
            ]);
            $reserveOffers->count += 2;
            $reserveOffers->save();

            $reserveOffers = $orderable->reserves()->firstOrNew([
                'service_id' => Service::where('group','article')->firstOrNew([])->id
            ]);
            $reserveOffers->count += 2;
            $reserveOffers->save();
        }

        if ($this->value == 2) {
            $reserveOffers = $orderable->reserves()->firstOrNew([
                'service_id' => Service::where('group','offer_top')->where('value','7')->firstOrNew([])->id
            ]);
            $reserveOffers->count += 10;
            $reserveOffers->save();

            $reserveOffers = $orderable->reserves()->firstOrNew([
                'service_id' => Service::where('group','poll')->firstOrNew([])->id
            ]);
            $reserveOffers->count += 5;
            $reserveOffers->save();

            $reserveOffers = $orderable->reserves()->firstOrNew([
                'service_id' => Service::where('group','webinar')->firstOrNew([])->id
            ]);
            $reserveOffers->count += 5;
            $reserveOffers->save();

            $reserveOffers = $orderable->reserves()->firstOrNew([
                'service_id' => Service::where('group','article')->firstOrNew([])->id
            ]);
            $reserveOffers->count += 2;
            $reserveOffers->save();

            $reserveOffers = $orderable->reserves()->firstOrNew([
                'service_id' => Service::where('group','mailer')->firstOrNew([])->id
            ]);
            $reserveOffers->count += 1;
            $reserveOffers->save();
        }

        if ($this->value == 3) {
            $reserveOffers = $orderable->reserves()->firstOrNew([
                'service_id' => Service::where('group','offer_top')->where('value','7')->firstOrNew([])->id
            ]);
            $reserveOffers->count += 10;
            $reserveOffers->save();

           $reserveOffers = $orderable->reserves()->firstOrNew([
                'service_id' => Service::where('group','poll')->firstOrNew([])->id
            ]);
            $reserveOffers->count += 5;
            $reserveOffers->save();

            $reserveOffers = $orderable->reserves()->firstOrNew([
                'service_id' => Service::where('group','article')->firstOrNew([])->id
            ]);
            $reserveOffers->count += 2;
            $reserveOffers->save();

            $reserveOffers = $orderable->reserves()->firstOrNew([
                'service_id' => Service::where('group','video')->firstOrNew([])->id
            ]);
            $reserveOffers->count += 2;
            $reserveOffers->save();

            $reserveOffers = $orderable->reserves()->firstOrNew([
                'service_id' => Service::where('group','mailer')->firstOrNew([])->id
            ]);
            $reserveOffers->count += 3;
            $reserveOffers->save();

            $reserveOffers = $orderable->reserves()->firstOrNew([
                'service_id' => Service::where('group','banner')->firstOrNew([])->id
            ]);
            $reserveOffers->count += 1;
            $reserveOffers->save();
        }
        

        $orderable->save();
    }
}
