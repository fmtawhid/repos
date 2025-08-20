<?php

namespace App\Services\Log;

use Illuminate\Support\Facades\Log;

class LogService
{

    #LOG CHANNELS
    const LOG_ORDER                = 'orderLog';
    const LOG_APP_REQUEST          = 'appRequest';

    const LOG_NOTIFICATION         = "notifications";
    const LOG_ADMIN_NOTIFICATION   = "adminNotifications";

    const LOG_PRODUCT              = "products";

    const LOG_OTP                  = "otpLog";
    const LOG_MERCHANT             = "merchant";
    const LOG_TICKET               = "ticketLog";
    const LOG_TICKET_REPLIES       = "ticketReplies";
    const LOG_ENVATO_API           = "envatoApi";
    const LOG_VALIDATION_ERROR     = "validationErrorLog";
    const LOG_FAILED_RESPONSE     = "failedResponseLog";
    const LOG_SYNTAX_ERROR         = "syntaxErrorLog";
    const LOG_SLOW_QUERY           = "slowQueries";
    const LOGIN_FAILED_LOGIN       = "failedLogin";
    const LOG_FALSE_RESPONSE       = "falseResponseLog";
    const LOG_SYSTEM_SETTING       = "systemSettingLog";
    const LOG_STRIPE               = "stripeLog";
    const LOG_OPEN_AI               = "openAiLog";
    const LOG_SD                   = "stableDiffusion";
    const LOG_AZZURE               = "azzureLog";
    const LOG_GOOGLE               = "googleLog";
    const LOG_ELEVEN_LABS          = "elevenLabsLog";
    const LOG_PAYPAL               = "paypalLog";
    const LOG_PROMPT               = "promptLog";
    const LOG_USER_BALANCE         = "userBalanceLog";
    const LOG_SEO                  = "seoLog";
    const LOG_MERCHANT_FAILED      = true;



    public function wLog($title = null,$payloads = [],$channel = "daily")
    {
        $data = [
            "url"              => currentUrl(),
            "auth_user_id"     => userID(),
            "title"            => $title,
            "request_time"     => manageDateTime(),
            "payloads"         => json_encode($payloads, JSON_THROW_ON_ERROR),
             "ip"               => $this->getIp(),

        ];

        Log::channel($channel)->info(json_encode($data));
    }

    public function commonLog($title = null,$payloads = [],$channel = "daily")
    {
        $data = [
            "url"              => currentUrl(),
            "auth_user_id"     => userID(),
            "title"            => $title,
            "request_time"     => manageDateTime(),
            "payloads"         => json_encode($payloads, JSON_THROW_ON_ERROR),
             "ip"               => $this->getIp(),

        ];

        Log::channel($channel)->info(json_encode($data));
    }

    public function getIp()
    {

        return request()->ip();
    }

    public function userInfo()
    {

        return request()->getUserInfo();
    }



    public function channels($channel = "daily"){

        return [
            self::LOG_APP_REQUEST,
            self::LOGIN_FAILED_LOGIN,
            self::LOG_NOTIFICATION,
            self::LOG_ADMIN_NOTIFICATION,
            self::LOG_PRODUCT,
            self::LOG_OTP,
            self::LOG_TICKET,
            self::LOG_TICKET_REPLIES,
            self::LOG_ENVATO_API,
            self::LOG_VALIDATION_ERROR,
            self::LOG_SYNTAX_ERROR,
            self::LOG_SLOW_QUERY
        ];
    }

}
