<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class SMSJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data=$data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       
        $url = "http://bangladeshsms.com/smsapi";
        $smsconf = [
            "api_key" => "C2007940602e4395b576d1.18187904",
            "type" => "text",
            "contacts" => $this->data['mobile'],
            "senderid" => "8809612446655",
            "msg" =>  $this->data['msg']
        ];
        $smstableid= $this->data['smstableid'];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$smsconf);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        DB::table('sms')->where('id', $smstableid) ->update(['sms_status' => 1]);

    }
}
