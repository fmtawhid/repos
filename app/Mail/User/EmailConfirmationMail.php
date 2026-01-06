<?php

namespace App\Mail\User;

use App\Models\User;
use App\Models\EmailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        try {
            $verificationCode = rand(100000, 999999);
            $this->user->update([
                "verification_code" => $verificationCode
            ]);
    
            $data['name'] = $this->user->name;
            $data['email'] = $this->user->email;
            $data['phone'] = $this->user->phone;
            $data['active_url'] = route('email.verification.confirmation', encrypt($verificationCode));
            $template = EmailTemplate::where('type', 'registration-verification')->where('is_active', 1)->first();
    
            if(!$template) return false;
    
            $subject = $template->subject;
            $body    = EmailTemplate::emailTemplateBody($template->code, $data);
    
    
            return $this
                ->view('emails.verification')
                ->with(["body" =>$body])
                ->subject(localize($subject));
        } catch (\Throwable $th) {
            wLog('Verification mail issues', errorArray($th));
        }

    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Email Confirmation Mail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
