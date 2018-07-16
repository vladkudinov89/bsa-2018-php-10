<?php

namespace App\Mail;

use App\Entity\Currency;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RateChanged extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $currency;
    protected $oldRate;
    /**
     * Create a new message instance.
     * @param User $user
     * @param Currency $currency
     * @param float $oldRate
     */
    public function __construct(User $user, Currency $currency, float $oldRate)
    {
        $this->user = $user;
        $this->currency = $currency;
        $this->oldRate = $oldRate;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.rate')
            ->with([
                'userName' => $this->user->name,
                'currencyName' => $this->currency->name,
                'oldRate' => $this->oldRate,
                'newRate' => $this->currency->rate,
            ]);
    }
}
