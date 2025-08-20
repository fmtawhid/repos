<?php

namespace App\Support\Constant;

use App\Constants\Messages;
use App\Constants\Flag;
use App\Constants\RequestResponse;

class ConstantService
{

    public function flags()
    {
        return new Flag();
    }

    public function messages()
    {
        return new Messages();
    }

    public function codes()
    {
        return new RequestResponse();
    }



}