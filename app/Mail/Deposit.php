<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Deposit extends Mailable
{
    use Queueable, SerializesModels;
    public $cart;
    public $finalTotal;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($cart,$finalTotal)
    {
        //
        $this->cart = $cart;
        $this->finalTotal = $finalTotal;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.deposit')->from('tatodeveloper1@gmail.com');
    }
}
