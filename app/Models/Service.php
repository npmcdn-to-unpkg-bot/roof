<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Service extends Model
{
    protected $table = 'services';

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

        $orderable->level = $this->value;
        $orderable->level_end = Carbon::now()->addYear();

        if ($orderable->max_level_ever < $orderable->level) {
            $orderable->max_level_start = Carbon::now();
            $orderable->max_level_ever = $orderable->level;
        }
        
        $orderable->save();

    }
}
