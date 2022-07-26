<?php

namespace App\Jobs;

//use App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Mail\UploadedMail;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
//use Illuminate\Mail;

class SendEmailJob implements ShouldQueue
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
        Log::debug("-------------Emails Job-----------");
        $datas= DB::table('emails')->where('email_status', 0)->get();
        Log::debug("Datas:");
        Log::debug($datas);


        foreach ($datas as $data){
            $email=$data->email;
            $emailsid=$data->id;
            $tracking=$data->tracking_id;
            Log::debug("Email ID: ");
            Log::debug($emailsid);

            $sellername= DB::table('failed_delivery')->where('tracking_id', $tracking)->first();
        
            if($data->category=='uploaded'){
                $emaildetails=[
                    'title'=> 'Daraz FDMS Update',
                    'sellecrname'=> $sellername
                ];
                Mail::to($email)->send(new UploadedMail($emaildetails));
            }
            else if($data->category=='inbound') {
                $emaildetails=[
                    'title'=> 'Daraz FDMS Update',
                    'sellecrname'=> $sellername
                ];
            }
            else{
                $emaildetails= null;
            }
            Log::debug($emaildetails);
            DB::table('emails')->where('id', $emailsid) ->update(['email_status' => 1]);


            // return $response;
        }
    }
}
