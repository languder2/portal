<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public object $data;

    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {

        $this->data = $data;
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->data->email)->send(new TestEmail($this->data));
    }
}
