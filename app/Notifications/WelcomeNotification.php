<?php

namespace App\Notifications;

use App\Models\EmailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class WelcomeNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $data['name']  = $notifiable->name;
        $data['email'] = $notifiable->email;
        $data['phone'] = $notifiable->phone;
        $template = EmailTemplate::where('type', 'welcome-email')->where('is_active', 1)->first();
        if(!$template) return false;
        $subject = $template->subject;
        $body    = EmailTemplate::emailTemplateBody($template->code, $data);
        return (new MailMessage)
            ->view('emails.verification', compact('body'))
            ->subject(localize( $subject));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
