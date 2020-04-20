<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\ErrorMailToAdmin;
use Illuminate\Support\Facades\Mail;

class ErrorHandledMailToAdminJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $error;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($error)
    {
        $this->error = $error;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to('philirol@hotmail.com')->send(new ErrorMailToAdmin($this->error));
    }
}
