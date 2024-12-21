<?php

namespace App\Jobs;

use App\Models\User;
use App\Mail\WelcomeEmail;  // Assuming you have a Mailable class for the email
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailables\Mail;
// use Illuminate\Support\Facades\Mail;

class SendWelcomeEmailJob implements ShouldQueue
{
    use Queueable;

    protected $user;

    /**
     * Create a new job instance.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Send the welcome email
        Mail::to($this->user->email)->send(new WelcomeEmail($this->user));
    }
}
