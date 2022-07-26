<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\FDMSMail;
use Illuminate\Support\Facades\DB;

class EmailJob implements ShouldQueue
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
        $emaildetails=$this->data;
        $emailtableid=$this->data['emailtableid'];
        Mail::to($this->data['email'])->send(new FDMSMail($emaildetails));

        DB::table('emails')->where('id', $emailtableid) ->update(['email_status' => 1]);

    }
}
