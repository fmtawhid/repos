<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use App\Mail\User\EmailConfirmationMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class EmailConfirmationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        wLog("Email Confirmation Mail Sending Start : {$this->user->id}", ["user" => $this->user]);
        $mail = Mail::to($this->user->email);
        $mail->send(new EmailConfirmationMail($this->user));
    }
}
