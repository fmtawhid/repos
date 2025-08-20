<?php

namespace App\Support\Facade\Language;

use Illuminate\Support\Facades\Facade;

class LanguageFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return "languageFacade";
    }
}