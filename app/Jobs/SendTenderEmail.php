<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Tender;
use App\User;
use Mail;

class SendTenderEmail extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $tender;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Tender $tender)
    {
        $this->tender = $tender;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::send('general.tenders.mail', ['tender'=>$this->tender], function($m){
            $m->from('no-reply@roofers.com.ua','roofers.com.ua')
            ->subject('Новый тендер на roofers.com.ua')
            ->bcc(
                User::whereHas('company',function($query){
                    $query->whereIn('level',[2,3]);
                })
                ->lists('email','id')
                ->all()
            );
        });
    }
}
