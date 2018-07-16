<?php

namespace App\Jobs;

use App\Mail\RateChanged;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendRateChangedEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $currency;
    public $oldRate;


    /**
     * SendRateChangedEmail constructor.
     * @param string $user
     * @param string $currency
     * @param float $oldRate
     */
    public function __construct($user, $currency , $oldRate)
    {
        $this->user = $user;
        $this->currency = $currency;
        $this->oldRate = $oldRate;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->user)->send(new RateChanged($this->user, $this->currency, $this->oldRate));
    }
}
