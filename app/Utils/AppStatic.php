<?php

namespace App\Utils;

class AppStatic
{
    CONST WRITE_RAP_LICENSE_URL = "https://client.themetags.net/";
    const DS              = DIRECTORY_SEPARATOR;
    const TRUE            = true;
    const FALSE           = false;
    const TYPE_FLAT       = 1;
    const TYPE_PERCENTAGE = 2;

    const IS_WP_SYNC      = 1;
    const ACTIVE          = 1;
    const EXPIRED         = 1;
    const IS_FOCUS_KEYWORD   = 1;

    # table data status
    public const STATUS_ARR = [
        1 => 'Active',
        2 => 'Disable',
    ];

    public const IS_PAID_STATUS_ARR = [
        1 => 'Paid',
        0 => 'UnPaid',
    ];

    CONST NEW_POST = 2;
    const EXISTING_POST = 1;
    const REWRITE_TYPES = [
        'rewrite'            => 'Re-Write',
        'summarize'          => 'Summarize',
        'make_it_longer'     => "Make it longer",
        'make_it_shorter'    => 'Make It Shorter',
        'improve_writing'    => 'Improve Writing',
        'grammar_correction' => 'Grammatical Improvement'
    ];

    # Event Error Detection
    const TT_ERROR = "[TT_ERROR]";


    #Affiliation Module
    public const AFFILIATE_EARNING_ONE_TIME  = 0;
    public const AFFILIATE_EARNING_LIFE_TIME  = 1;

    const maxUpdateFile  = -5;

    # CURL Center
    const CURL_RESPONSE_BODY                        = 1;
    const CURL_RESPONSE_CODE                        = 2;
    const CURL_RESPONSE_HEADER                      = 3;
    const CURL_RESPONSE_CODE_WITH_BODY              = 4;
    const CURL_RESPONSE_CODE_WITH_BODY_AND_HEADERS  = 5;

    # subscription plan status
    const PLAN_STATUS_ACTIVE     = 1;
    const PLAN_STATUS_EXPIRE     = 2;
    const PLAN_STATUS_SUBSCRIBED = 3;
    const PLAN_STATUS_PENDING    = 4;
    const PLAN_STATUS_REJECTED   = 5;
    const PLAN_PURCHASE_LIMIT    = 1;
    CONST SPEECH_2_TEXT_FILE_SIZE_LIMIT = 1;

    public const SUBSCRIPTION_STATUS_ACTIVE     = 1;
    public const SUBSCRIPTION_STATUS_EXPIRED    = 2;
    public const SUBSCRIPTION_STATUS_SUBSCRIBED = 3;
    public const SUBSCRIPTION_STATUS_PENDING    = 4;

    # Package Type
    const PACKAGE_TYPE_STARTER  = 'starter';
    const PACKAGE_TYPE_MONTHLY  = 'monthly';
    const PACKAGE_TYPE_YEARLY   = 'yearly';
    const PACKAGE_TYPE_LIFETIME = 'lifetime';
    const PACKAGE_TYPE_PREPAID  = 'prepaid';

    const PACKAGE_TYPE_ARR = [
      self::PACKAGE_TYPE_MONTHLY  => self::PACKAGE_TYPE_MONTHLY,
      self::PACKAGE_TYPE_YEARLY   => self::PACKAGE_TYPE_YEARLY,
    ];

    # payment status
    const PAYMENT_STATUS_PAID     = 1;
    const PAYMENT_STATUS_PENDING  = 2;
    const PAYMENT_STATUS_REJECTED = 3;
    const PAYMENT_STATUS_RESUBMIT = 4;

    # plan type status
    const PLAN_TYPE_STARTER  = 'starter';
    const PLAN_TYPE_MONTHLY  = 'monthly';
    const PLAN_TYPE_YEARLY   = 'yearly';
    const PLAN_TYPE_LIFETIME = 'lifetime';
    const PLAN_TYPE_PREPAID  = 'prepaid';

    const OFFLINE_PAYMENT_METHOD =  'offline';

    const OFFLINE_PAYMENT_GATEWAY_ID = 13;

    # Request Response Codes
    public const SUCCESS            = 200;
    public const SUCCESS_WITH_DATA  = 201;
    public const VALIDATION_ERROR   = 400;
    public const NOT_FOUND          = 404;
    public const UNAUTHORIZED        = 401;
    public const UNAUTHORIZED_ACTION = 401;

    public const LENGTH_ERROR       = 411;
    public const INTERNAL_ERROR     = 500;
    public const INVALID            = 525;
    public const DUPLICATE_CODE     = 23000;
    public const OPEN_AI_ERROR_CODE = 505;
    public const BALANCE_ERROR      = 400;

    public const RESPONSE_STATUS   = [
        200 => ['status' => true,   'response_code' => 200],
        201 => ['status' => true,   'response_code' => 201],
        400 => ['status' => false,  'response_code' => 400],
        401 => ['status' => false,  'response_code' => 401],
        404 => ['status' => false,  'response_code' => 404],
        411 => ['status' => false,  'response_code' => 411],
        500 => ['status' => false,  'response_code' => 500],
    ];

    public const INPUT_TYPES   = [
        'text'     => 'Text',
        'textarea' => 'Textarea'
    ];


    #Login Center
    public const MESSAGE_WELCOME_BACK           = "Welcome Back!";
    public const MESSAGE_SUCCESS_LOGOUT         = "Aww! Logout. We are waiting for you ;) Come back soon!.";
    public const MESSAGE_INVALID                = "Invalid Information!";
    public const MESSAGE_PROFILE                = "Authorized user Data";
    public const MESSAGE_UNAUTHORISED           = "Opps! You are not authorized, please Login first.";
    public const MESSAGE_DELETE                 = "Deleted! A Record successfully deleted";
    public const MESSAGE_STORE                  = "A Record has been successfully stored.";
    public const MESSAGE_UPDATE                 = "A Record has been successfully updated.";
    public const MESSAGE_DELETE_SUCCESS_POP_UP  = "Deleted!";
    public const MESSAGE_ACTION_FAILED          = "Sorry, Can't complete the action.";
    public const MESSAGE_EXPIRED                = "Sorry, It's already expired";
    public const MESSAGE_TICKET_CLOSED          = "Sorry, This ticket has already been closed.";
    public const MESSAGE_KEYWORD_GENERATED      = "Successfully New Keywords content generated.";
    public const MESSAGE_TITLE_GENERATED        = "Successfully New Titles content generated.";
    public const MESSAGE_OUTLINE_GENERATED      = "Successfully New Outlines content generated.";
    public const MESSAGE_ARTICLE_GENERATED      = "Successfully New Article content generated.";
    public const MESSAGE_CODE_GENERATED         = "Successfully New Code content generated.";
    public const MESSAGE_IMAGE_GENERATED        = "Successfully AI image generated.";
    public const MODEL_NOT_FOUND_MESSAGE        = "Not Found Exception!";
    public const MESSAGE_UNAUTHORIZED           = "Sorry! You are not authorized to perform this action.";
    public const MESSAGE_NO_WORD_BALANCE        = "Sorry! You don't have enough word balance remaining.";



    #Exceptions Center
    public const METHOD_NOT_ALLOWED             = "Method Not Allowed Http Exception Found";
    public const MESSAGE_DUPLICATE_ENTRY        = "The record  :attribute could not be inserted because a duplicate already exists.";

    # Messages Center
    public const ORDER_PENDING_NOTE     = "Sir/Madam, We received a order from you. Currently our team is working with your order, We will update you soon. Thank you.";

    public const MESSAGE_STATUS_UPDATE         = "A record status has been successfully updated";
    public const MESSAGE_STATUS_WARNING        = "You are not authorize to update this record";

    # USER TYPES
    public const USER_TYPES = [
        1  => 'Super Admin',
        2  => 'Admin Staff',
        3  => 'Vendor',
        31 => 'Vendor Team',
        4  => 'Customer'
    ];

    const TYPE_ADMIN          = 1;
    const TYPE_ADMIN_STAFF    = 2;
    const TYPE_VENDOR         = 3;
    const TYPE_VENDOR_TEAM    = 31;
    const TYPE_CUSTOMER       = 4;

    public const TICKET_STATUS_INSIDE   = "0 = Open, 1 = Completed/Closed, 2 = In-progress, 3 = Assigned, 4 = On-Hold, 5 = Solved, 6=Re-opened.";
    public const ACCOUNT_STATUS_INSIDE  = "0 = De-active, 1 = Active, 2 = Pending, 3 = Suspended.";


    //----------------------------------------
    // Account Status
    //----------------------------------------
    public const ACCOUNT_STATUS_LIST  = ['1' => 'Active', '2' => 'Inactive', '3' => 'Pending', '4' => 'Suspended'];
    public const ACCOUNT_STATUS_ACTIVE     = 1;
    public const ACCOUNT_STATUS_INACTIVE   = 2;
    public const ACCOUNT_STATUS_PENDING    = 3;
    public const ACCOUNT_STATUS_SUSPENDED  = 4;



    public const ACTIVE_STATUS_INSIDE   = "0 = In-active, 1 = Active.";

    # Pagination setting
    public const PER_PAGE_DEFAULT   = 15;
    public const PER_PAGE_ARR       = [10,20,30, 50, 100, 200, 500];


    public const MYSQL_EXCEPTIONS  = [
        1045 => "Access denied for user (using password: YES/NO)",
        1054 => "Unknown column in 'field list'",
        1062 => "Duplicate entry for key",
        1064 => "Syntax error in SQL statement",
        1136 => "Column count doesn't match value count at row",
        1146 => "Table doesn't exist",
        1217 => "Cannot delete or update a parent row: a foreign key constraint fails",
        1364 => "Field doesn't have a default value",
        1451 => "Cannot delete or update a parent row: a foreign key constraint fails",
        1452 => "Cannot add or update a child row: a foreign key constraint fails",
        2002 => "Can't connect to local MySQL server through socket",
        2013 => "Lost connection to MySQL server during query",
    ];

    public const DATE_FORMAT_LIST = [
            'jS M, Y'                   => '22th May, 2024',
            'Y-m-d'                     => '2024-05-22',
            'Y-d-m'                     => '2024-22-05',
            'd-m-Y'                     => '22-05-2024',
            'm-d-Y'                     => '05-22-2024',
            'Y/m/d'                     => '2024/05/22',
            'Y/d/m'                     => '2024/22/05',
            'd/m/Y'                     => '22/05/2024',
            'm/d/Y'                     => '05/22/2024',
            'l jS \of F Y'              => 'Monday 22th of May 2024',
            'jS \of F Y'                => '22th of May 2024',
            'g:ia \o\n l jS F Y'        => '12:00am on Monday 22th May 2024',
            'F j, Y, g:i a'             => 'May 22 2024, 3:00 pm',
            'F j, Y'                    => 'May 22, 2024',
            '\i\t \i\s \t\h\e jS \d\a\y'=> 'it is the 22th day'
    ];

    /**
     * Webhook Manage
     * */
    const HOOK_STRIPE_CUSTOMER_CREATED = "customer.created";
    const HOOK_STRIPE_CUSTOMER_UPDATED = "customer.updated";
    const HOOK_STRIPE_CUSTOMER_DELETED = "customer.deleted";

    const HOOK_CUSTOMER_SUBSCRIPTION_CREATED = "customer.subscription.created";
    const HOOK_CUSTOMER_SUBSCRIPTION_UPDATED = "customer.subscription.updated";
    const HOOK_CUSTOMER_SUBSCRIPTION_DELETED = "customer.subscription.deleted";

    const HOOK_PAYMENT_INTENT_SUCCEEDED = "payment_intent.succeeded";
    const HOOK_PAYMENT_INTENT_EXPIRED = "payment_intent.expired";
    const HOOK_PAYMENT_INTENT_FAILED = "payment_intent.failed";
    const HOOK_INVOICE_CREATED = "invoice.created";
    const HOOK_INVOICE_FINALIZED = "invoice.finalized";
    const HOOK_INVOICE_PAYMENT_SUCCEEDED = "invoice.payment_succeeded";
    const HOOK_INVOICE_PAYMENT_FAILED = "invoice.payment_failed";
    const HOOK_CHECKOUT_SESSION_COMPLETED = "checkout.session.completed";

    const DEFAULT_CURRENCY_CODE = "usd";


    /**
     * #################################
     * #     Delivery Status Start     #
     * #################################
     * */
    const CANCEL_REQUEST_ACCEPT = 'accept';
    const CANCEL_REQUEST_REJECT = 'reject';

    const ORDER_CANCEL_PENDING = 0;
    const ORDER_CANCEL_APPROVE = 1;
    const ORDER_CANCEL_REJECT = 2;

    const ORDER_CANCELED = 13; // ORDER CANCELED BY CUSTOMER / ADMIN / MERCHANT / SUPPLIER

    const ORDER_CANCEL_CUSTOMIZED_VALUE = 13;

    const ORDER_CANCELED_TEXT = "Canceled";
    const ORDER_COMPLETED = 1; // SUCCESSFUL COMPLETION
    const ORDER_DELIVERED = 1; // SUCCESSFUL COMPLETION
    const ORDER_COMPLETED_TEXT = "Delivered";
    const ORDER_CONFIRMED = 4; // Order Confirmed
    const ORDER_CONFIRMED_TEXT = "Confirmed";

    const ORDER_DECLINED = 2; // DECLINED BY DELIVERY-BOY AS PER CUSTOMER REQUEST
    const ORDER_DECLINED_TEXT = "Pending";

    const ORDER_PENDING = 2; // PENDING OR ON-PROGRESS
    const ORDER_PENDING_TEXT = "Pending";

    //Picked up
    const ORDER_PICKED_UP = 5;
    const ORDER_PICKED_UP_TEXT = "Picked up";

    const ORDER_PROCESSING = 6;
    const ORDER_PROCESSING_TEXT = "Processing";

    const ORDER_SHIPPED = 7;
    const ORDER_SHIPPED_TEXT = "Shipped";

    const ORDER_RECEIVED_BY_WAREHOUSE = 8;
    const ORDER_RECEIVED_BY_WAREHOUSE_TEXT = "Received by Warehouse";

    const ORDER_DELIVERY_BOY_ASSIGNED = 9;
    const ORDER_DELIVERY_BOY_ASSIGNED_TEXT = "Delivery Boy Assigned";

    const ORDER_READY_TO_DELIVERY = 10;
    const ORDER_READY_TO_DELIVERY_TEXT = "Ready to Delivery";

    const ORDER_SEND_OTP = 11;
    const ORDER_SEND_OTP_TEXT = "Send OTP";
    const ORDER_OTP_VERIFIED = 12;
    const ORDER_OTP_VERIFIED_TEXT = "OTP Verified";

    const ORDER_CANCELLED = 2;
    const ORDER_CANCELLED_TEXT = "Canceled";

    const ORDER_ON_THE_WAY_TO_DELIVERY = 14;
    const ORDER_ON_THE_WAY_TO_DELIVERY_TEXT = "On The Way To Delivery";

    const DElIVERY_CHARGE_AMOUNT = 50;

    //    Delivery Status Access
    const DELIVERY_BOY_ACCESS_TRUE = 1;


    //5 = Packaging Done,6 = Handover to the Courier,7 = Product Shipped,8 = Shipment Done,
    //9 = Product delivering via Delivery Boy

    const ORDER_STATUSES_ENUM = [
        self::ORDER_CANCELED                => self::ORDER_CANCELED_TEXT,
        self::ORDER_CANCELLED               => self::ORDER_CANCELLED_TEXT,
        self::ORDER_CONFIRMED               => self::ORDER_CONFIRMED_TEXT,
        self::ORDER_COMPLETED               => self::ORDER_COMPLETED_TEXT,
        self::ORDER_DECLINED                => self::ORDER_DECLINED_TEXT,
        self::ORDER_PENDING                 => self::ORDER_PENDING_TEXT,
        self::ORDER_RECEIVED_BY_WAREHOUSE   => self::ORDER_RECEIVED_BY_WAREHOUSE_TEXT,
        self::ORDER_DELIVERY_BOY_ASSIGNED   => self::ORDER_DELIVERY_BOY_ASSIGNED_TEXT,
        self::ORDER_PICKED_UP               => self::ORDER_PICKED_UP_TEXT,
        self::ORDER_ON_THE_WAY_TO_DELIVERY  => self::ORDER_ON_THE_WAY_TO_DELIVERY_TEXT,
        self::ORDER_READY_TO_DELIVERY       => self::ORDER_READY_TO_DELIVERY_TEXT,
        self::ORDER_SEND_OTP                => self::ORDER_SEND_OTP_TEXT,
        self::ORDER_OTP_VERIFIED            => self::ORDER_OTP_VERIFIED_TEXT,
    ];


    /**
     * #################################
     * #       ORDER FLAG'S START      #
     * #################################
     * */

    public const PAYMENT_METHODS = [
        'cod'  => 'COD',
        'cash' => 'CASH',
        'card' => 'CARD PAYMENT'
    ];

    const PAYMENT_METHOD_COD          = 'cod';
    const PAYMENT_METHOD_CASH         = 'cash';
    const PAYMENT_METHOD_CARD         = 'card';

    const PAYMENT_METHOD_COD_TEXT           ="Cash on Delivery";
    const PAYMENT_METHOD_CASH_TEXT          ="Cash Received";
    const PAYMENT_METHOD_CARD_TEXT  ="Card Payment";


    CONST COD = "cod";
    const CREDIT  = "credit"; // if new amount in means credit
    const DEBIT  = "debit"; // withdraw or invest or cost as debit

    // Payments
    const PAYMENT_UNPAID   = 0;
    const PAYMENT_PAID     = 1;
    const PAYMENT_PARTIAL  = 2;

    const ORDER_FROM_CUSTOMER = 1;
    const ORDER_FROM_MERCHANT = 2;

    const ORDER_REFUND_PENDING  = 0;
    const ORDER_REFUND_APPROVED = 1;
    const ORDER_REFUND_REJECT   = 2;
    const ORDER_PRODUCT_IS_NOT_REFUND = 0;


    /**
     * #################################
     * #       ORDER FLAG'S END        #
     * #################################
     * */


    /**
     * ######################################
     * #       Payment Gateway Start        #
     * ######################################
     * */
    const GATEWAY_CARD = "card";
    const GATEWAY_COD = "cod";
    const GATEWAY_CASH = "cash";
    const GATEWAY_PAYGATEGLOBAL = "payGateGlobal";
    const PAYMENT_REJECTED   = 0;
    const PAYMENT_SUCCESS     = 1;
    const PAYMENT_PROCESSING  = 2;
    const MANUAL_PAYMENT    = 0;
    const AUTOMATIC_PAYMENT = 1;
    const GATEWAY_WALLET         = "WALLET";
    const GATEWAY_FUNDING_WALLET = "FUNDING_WALLET";
    /**
     * ######################################
     * #       Payment Gateway END          #
     * ######################################
     * */

    // POS

    const DELIVERY_DINE_IN = 1;
    CONST DELIVERY_DINE_IN_TXT = "Dine In";

    const DELIVERY_PICKUP = 2;
    CONST DELIVERY_PICKUP_TXT = "Pickup";


    const POS_DELIVERY_TYPES = [
        self::DELIVERY_DINE_IN => self::DELIVERY_DINE_IN_TXT,
        self::DELIVERY_PICKUP =>  self::DELIVERY_PICKUP_TXT,
    ];




    // CHECK with text - get id
    public const STATUS_ID = [
        'COMPLETED' => 1,
        'PENDING'   => 2,
        'CANCELLED' => 3,
        'HOLD'      => 4,
        // ... more
    ];


}
