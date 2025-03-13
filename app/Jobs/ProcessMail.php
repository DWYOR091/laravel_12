<?php

namespace App\Jobs;

use App\Mail\CobaMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class ProcessMail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public $users)
    {
        // dd($this->users);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to('kiki@gmail.com')->send(new CobaMail($this->users));
        sleep(1);
    }
}
