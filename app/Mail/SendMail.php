<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $orders;


    public function __construct($orders)
    {
        $this->orders = $orders;
    }



    public function build()
    {
        return $this->from('mantas.stirpeika@gmail.com')->subject('Purchased Product')->view('mail.invoice')->with('orders', $this->orders);
    }
}
