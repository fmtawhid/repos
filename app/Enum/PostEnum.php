<?php

namespace App\Enum;

enum PostEnum
{
    const STATUS_DRAFT   = "draft";
    const STATUS_PUBLISH = "publish";
    const STATUS_FUTURE  = "future";
    const STATUS_PENDING = "pending";
    const STATUS_PRIVATE = "private";
}
