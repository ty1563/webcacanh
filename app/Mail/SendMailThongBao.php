<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMailThongBao extends Mailable
{
    use Queueable, SerializesModels;

    public $noiDung;
    public $title;

    public function __construct($title, $noiDung)
    {
        $this->title = $title;
        $this->noiDung = $noiDung;
    }

    public function build()
    {
        return $this->subject($this->title)->html($this->noiDung);
    }
}
