<?php
namespace App\Services\Email;
use Illuminate\Support\Facades\Mail;

class MailService
{
    protected $subject;
    protected $cc = [];
    protected $bcc = [];
    protected $attachments = [];

    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    public function setCc(array $cc)
    {
        $this->cc = $cc;
        return $this;
    }

    public function setBcc(array $bcc)
    {
        $this->bcc = $bcc;
        return $this;
    }

    public function addAttachment($filePath)
    {
        $this->attachments[] = $filePath;
        return $this;
    }

    public function send($to, $view, $data = [])
    {
        Mail::send($view, $data, function ($message) use ($to) {
            $message->to($to);
            $message->subject($this->subject);

            if (!empty($this->cc)) {
                $message->cc($this->cc);
            }

            if (!empty($this->bcc)) {
                $message->bcc($this->bcc);
            }

            foreach ($this->attachments as $attachment) {
                $message->attach($attachment);
            }
        });
    }
}
