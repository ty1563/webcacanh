<?php

namespace App\Jobs;

use App\Mail\SendMailThongBao;
use App\Models\ThongBao;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class JobSendMailThongBao implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        $noiDung = $this->data['noi_dung'];
        $title = $this->data['title'];
        $listEmails = $this->data['listEmail'];

        foreach ($listEmails as $emailInfo) {
            ThongBao::create([
                'email' => $emailInfo['email'],
            ]);
            if ($emailInfo['status'] === "1") {
                Mail::to($emailInfo['email'])->send(new SendMailThongBao($title, $noiDung));
            }
        }
    }
}
