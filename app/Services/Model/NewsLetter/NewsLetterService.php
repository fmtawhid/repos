<?php

namespace App\Services\Model\NewsLetter;

use App\Models\User;
use App\Mail\EmailManager;
use App\Models\SubscribedUser;
use App\Services\Model\User\UserService;
use Illuminate\Support\Facades\Mail;


class NewsLetterService 
{    
    public function index()
    {
        $data['users']       = (new UserService())->getAllUsersExceptAdminAndAdminStaff();
        $data['subscribers'] = SubscribedUser::all();

        return $data;
    }
    public function send($request)
    {
        $message = null;
        if (env('MAIL_USERNAME') != null) {
            //sends newsletter to subscribed users
            if ($request->has('subscriber_emails')) {
                foreach ($request->subscriber_emails as $key => $email) {
                    $array['view'] = 'emails.bulkEmail';
                    $array['subject'] = $request->subject;
                    $array['from'] = env('MAIL_FROM_ADDRESS');
                    $array['content'] = $request->content;
                    try {
                        Mail::to($email)->queue(new EmailManager($array));
                    } catch (\Exception $e) {
                        $message = $e->getMessage();
                    }
            	}
            }

            //sends newsletter to users
        	if ($request->has('user_emails')) {
                foreach ($request->user_emails as $key => $email) {
                    $array['view'] = 'emails.bulkEmail';
                    $array['subject'] = $request->subject;
                    $array['from'] = env('MAIL_FROM_ADDRESS');
                    $array['content'] = $request->content;

                    try {
                        Mail::to($email)->queue(new EmailManager($array));
                    } catch (\Exception $e) {
                        $message = $e->getMessage();
                    }
            	}
            }
        } else {
          
            $message = localize('Please configure SMTP first');
        }
        $message = localize('Newsletter has been sent');
    	return $message;
    }
}