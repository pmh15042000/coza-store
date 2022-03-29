<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TrafficMail extends Mailable
{
    use Queueable, SerializesModels;

    public $time;
    public $visitor;
    public $totalTraffic;
    public $totalVisitors;
    public function __construct($time,$visitor,$totalTraffic,$totalVisitors)
    {
        $this->time = $time;
        $this->visitor= $visitor;
        $this->totalTraffic= $totalTraffic;
        $this->totalVisitors= $totalVisitors;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Mail from pmhstore.io')->view('mail.traffic');
    }
}
