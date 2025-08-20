<?php

namespace App\Constants;

class Messages
{
    public const METHOD_NOT_ALLOWED                 = "Method Not Allowed Http Exception Found";
    public const MESSAGE_DUPLICATE_ENTRY            = "The record :attribute could not be inserted because a duplicate already exists.";
    public const MESSAGE_SUCCESS_LOGIN              = "Login Successful!";
    public const MESSAGE_WELCOME_BACK               = "Welcome Back!";
    public const MESSAGE_REGISTERED                 = "Congratulations! Your registration was successful. Welcome aboard!";
    public const MESSAGE_PASSWORD_CHANGED           = "Congratulations! Your password has been changed successfully. Welcome onboard!";
    public const MESSAGE_REGISTRATION_FAILED        = "Oops! Something went wrong during registration. Please try again later. 😔";
    public const MESSAGE_SOMETHING_WENT_WRONG       = "Oops! Something went wrong during registration. Please try again later. 😔";
    public const MESSAGE_SUCCESS_LOGOUT             = "Aww! Logout. We are waiting for you ;) Come back soon!.";
    public const MESSAGE_INVALID                    = "Invalid Information!";
    CONST MESSAGE_UNAUTHORIZED                      = "Unauthorized! Action is not allowed.";
    public const MESSAGE_PROFILE                    = "Authorized user Data";
    public const MESSAGE_UNAUTHORISED               = "Opps! You are not authorized, please Login first.";
    public const MESSAGE_DELETE                     = "Deleted! A Record successfully deleted";
    public const MESSAGE_STORE                      = "A Record has been successfully stored.";
    public const MESSAGE_UPDATE                     = "A Record has been successfully updated.";
    public const MESSAGE_DELETE_SUCCESS_POP_UP      = "Deleted!";
    public const MESSAGE_ACTION_FAILED              = "Sorry, Can't complete the action.";
    public const MESSAGE_STATUS_UPDATE              = "A record status has been successfully updated";
    public const MESSAGE_INSUFFICIENT_STOCK         = "Sorry, insufficient Stock";
    public const SUBSCRIBE_MESSAGE                  = "Successfully Subscribed";
    public const SETTING_GENERAL_MESSAGE            = "Successfully, General Settings is Updated.";
    public const WISHLIST_INVALID_CUSTOMER          = "Invalid customer";
    public const WISHLIST_UPDATE_MESSAGE            = "Wishlist Is Updated";
    public const AJAX_QUICK_VIEW                    = "Product details for quick view";
    public const MODEL_NOT_FOUND_MESSAGE            = "Not Found Exception!";

    /**
     * #########################################
     *          GENERAL MESSAGES START
     * #########################################
     * */
    const TEXT_PENDING    = "Pending";
    const TEXT_PROCESSING = "Processing";
    const TEXT_SHIPPED    = "Shipped";
    const TEXT_DELIVERED  = "Delivered";
    const TEXT_DECLINED   = "Declined";
    const TEXT_CANCELED   = "Canceled";
    const TEXT_PAID       = "Paid";
    const TEXT_UNPAID     = "Unpaid";

    const GENDERS = [
        'male'   => 'Male',
        'female' => 'Female',
        'others' => 'Others',
    ];

    /**
     * #########################################
     *           GENERAL MESSAGES END
     * #########################################
     * */


    /**
     * #########################################
     *           TABLE COMMENT MESSAGES
     * #########################################
     * */
    const OWNER_TYPE_INSIDE = "1=Merchant,2=Supplier";

    /**
     * #########################################
     *           TABLE COMMENT MESSAGES
     * #########################################
     * */

    const PAYMENT_STATUS_TEXT_ARR = [
        0 => "Unpaid",
        1 => "Paid",
        2 => "Partial Paid",
    ];
}
