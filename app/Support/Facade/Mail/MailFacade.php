<?php

namespace App\Support\Facade\Mail;

use Illuminate\Support\Facades\Facade;

class MailFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return "mailService";
    }
}