<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class XacNhanReset extends Mailable
{
    use Queueable, SerializesModels;

    protected $hash_reset;
    public function __construct($hash_reset)
    {
        $this->hash_reset = $hash_reset;
    }

    public function build()
    {
        return $this->subject('Mã Xác Nhận')
            ->view('Client.Login.emailResetPassword', [
                'hash_reset' => $this->hash_reset,
            ]);
    }
}
