<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function emailTemplateBody($body, $data)
    {
        // user info
        $body = str_replace('[name]', @$data['name'], $body);
        $body = str_replace('[email]', @$data['email'], $body);
        $body = str_replace('[phone]', @$data['phone'], $body);

        // package info
        $body = str_replace('[package]', @$data['package'], $body);
        $body = str_replace('[price]', @$data['price'], $body);
        $body = str_replace('[note]', @$data['note'], $body);
        $body = str_replace('[method]', @$data['method'], $body);
        $body = str_replace('[startDate]', @$data['start_date'], $body);
        $body = str_replace('[endDate]', @$data['end_date'], $body);

        //  ticket info
        $body = str_replace('[ticketId]', @$data['id'], $body);
        $body = str_replace('[title]', @$data['title'], $body);

        // system info
        $body = str_replace('[system_title]', getSetting('system_title'), $body);
        $body = str_replace('[system_email]', getSetting('contact_email'), $body);
        $body = str_replace('[system_phone]', getSetting('contact_phone'), $body);
        
        $login_url = route('login');
        $body = str_replace('[active_url]', @$data['active_url'], $body);
        $body = str_replace('[login_url]', @$login_url, $body);

        return $body;
    }
}
