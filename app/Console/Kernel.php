<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function(){

            $liqpay = new \LiqPay(env("LIQPAY_PUBLIC_KEY"), env("LIQPAY_PRIVAT_KEY"));

            $orders = \App\Models\Order::whereNotIn('status', [
                'success',
                'failure',
                'error',
                'subscribed',
                'unsubscribed',
                'reversed',
                'sandbox',
                ''
            ])->get();

            foreach ($orders as $order) {
                $data = $liqpay->api("payment/status", array(
                    'version'       => '3',
                    'order_id'      => $order->id
                ));

                $order->liqpay_response = json_encode($data);

                $order->status = $data->status;

                if ($data->status=='success') {
                    $order->payed = 1;
                    $order->apply();
                }else{
                    $order->payed = 0;
                }

                $order->save();
            }

        })->everyMinute();
    }
}
