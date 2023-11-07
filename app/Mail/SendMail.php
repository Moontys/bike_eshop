<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $allOrders;


    public function __construct($allOrders)
    {
        $this->allOrders = $allOrders;
    }



    public function build()
    {
        return $this->from('mantas.stirpeika@gmail.com')->subject('Purchased Product')->view('mail.invoice')->with('allOrders', $this->allOrders);
    }
}