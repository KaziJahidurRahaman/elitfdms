<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SendSMSJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $datas= DB::table('sms')
            ->where('sms_status', 0)->get();
        Log::debug("Datas:");
        Log::debug($datas);


        foreach ($datas as $data){
            $number=$data->phone;
            $smsid=$data->id;
            Log::debug("SMS ID: ");
            Log::debug($smsid);
        
            if($data->category=='uploaded'){
                //$msg="a";
                $msg="Dear Seller, Your package is recieved by Daraz Failed Delivery management System.";
            }
            else if($data->category=='inbound') {
                //$msg="b";
                $msg= "Dear Seller <Seller> <br>The following packages are waiting for your pick up at our <Hub Name> Hub. Please collect your package by <Last Date of Collection> to prevent it from getting scraped.";
            }
            else{
                $msg= null;
            }

            Log::debug($msg);

            $url = "http://bangladeshsms.com/smsapi";
            $data = [
                "api_key" => "C2007940602e4395b576d1.18187904",
                "type" => "text",
                "contacts" => $number,
                "senderid" => "8809612446655",
                "msg" => $msg,
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            curl_close($ch);




            DB::table('sms')->where('id', $smsid) ->update(['sms_status' => 1]);
            
            // Log::debug("Api Response: ");
            Log::debug($response);

            // return $response;
        }
    }
}
