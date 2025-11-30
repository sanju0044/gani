<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\SendEmail;
use Mail;
use Illuminate\Support\Facades\Log;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $details;
    

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
       
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            Log::info("You are in email job and queue",["Details " => $this->details]);
            $email = new SendEmail($this->details);
            Mail::to($this->details['email'])->send($email);
        } catch (Swift_RfcComplianceException $e) {
            Log::error('Error sending email to ' . $email . ': ' . $e->getMessage());
        } catch (\Exception $e){
            Log::info("Unexpected error in sending mail",["Details " => $this->details, "Error " => $e->getMessage()]);
        }
    }
}
