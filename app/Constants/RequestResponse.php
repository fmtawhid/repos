<?php

namespace App\Constants;

class RequestResponse
{
    const TRUE                 = true;
    const FALSE                = false;
    const SUCCESS              = 200;
    const SUCCESS_WITH_DATA    = 201;
    const UNAUTHORIZED_ACTION  = 401;
    const VALIDATION_ERROR     = 400;
    const BAD_REQUEST          = 400;
    const BAD_CART_PERMISSION  = 409;
    const NOT_FOUND            = 404;
    const FORBIDDEN            = 403;
    const INTERNAL_ERROR       = 500;
    const NOT_IMPLEMENTED      = 501;
    const BAD_GATEWAY          = 502; // Communication failed with server. (Server Down)
    const SERVICE_NOT_AVILABLE = 503; // Server is overloaded beyond capacity

    public const INVALID        = 525;
    CONST STOCK_OUT_CODE        = 666;
    CONST FIELD_REQUIRED        = 700;
    CONST INSUFICIENT_BALANCE   = 711;
    const DUPLICATE_CODE        = 23000; // MySQL Exception Duplicate Code
    const INSUFICIENT_STOCK_CODE = 525; // Stock Insuficient Exception
    const FOLLOW_MYSELF = 202; // You Can't follow yourself

    const RESPONSE_STATUS = [
        200 => ['status' => true,   'response_code' => 200],
        201 => ['status' => true,   'response_code' => 201],
        400 => ['status' => false,  'response_code' => 400],
        401 => ['status' => false,  'response_code' => 401],
        404 => ['status' => false,  'response_code' => 404],
        411 => ['status' => false,  'response_code' => 411],
        500 => ['status' => false,  'response_code' => 500],
        202 => ['status' => false,  'response_code' => 202],
    ];

    #wishlist message

    public const WISHLIST_INVALID_CUSTOMER  = "Invalid customer";
    public const WISHLIST_UPDATE_MESSAGE  = "Wishlist Is Updated";
    public const WISHLIST_ITEM_DELETED_MESSAGE  = "Product deleted from wishlist";
    public const WISHLIST_ITEM_ADDED_MESSAGE  = "Wishlist is updated";



    #Login Center
    public const MESSAGE_WELCOME_BACK   = "Welcome Back!";
    public const MESSAGE_REGISTERED   = "Congratulations! Your registration was successful. Welcome aboard!";
    public const MESSAGE_REGISTRATION_FAILED   = "Oops! Something went wrong during registration. Please try again later. 😔";
    public const MESSAGE_SUCCESS_LOGOUT = "Aww! Logout. We are waiting for you ;) Come back soon!.";
    public const MESSAGE_INVALID        = "Invalid Information!";
    public const MESSAGE_PROFILE        = "Authorized user Data";
    public const MESSAGE_UNAUTHORISED   = "Opps! You are not authorized, please Login first.";
    public const MESSAGE_DELETE         = "Deleted! A Record successfully deleted";
    public const MESSAGE_STORE          = "A Record has been successfully stored.";
    public const MESSAGE_UPDATE         = "A Record has been successfully updated.";
    public const MESSAGE_DELETE_SUCCESS_POP_UP  = "Deleted!";
    public const MESSAGE_ACTION_FAILED  = "Sorry, Can't complete the action.";
    public const MESSAGE_STATUS_UPDATE  = "A record status has been successfully updated";
    public const MESSAGE_INSUFFICIENT_STOCK  = "Sorry, insufficient Stock";
    public const SUBSCRIBE_MESSAGE  = "Successfully Subscribed";



}
